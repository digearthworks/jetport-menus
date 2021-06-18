<?php

namespace App\Core\Auth\Actions;

use App\Core\Auth\Models\User;
use App\Core\Events\User\UserUpdated;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserAction
{
    private UpdatesUserProfileInformation $updatesUserProfileInformation;

    private UpdateUserTypeAction $updateUserTypeAction;

    private UpdateUserMenusAction $updateUserMenusAction;

    private UpdateUserPermissionsAction $updateUserPermissionsAction;

    public function __construct(
        UpdatesUserProfileInformation $updatesUserProfileInformation,
        UpdateUserMenusAction $updateUserMenusAction,
        UpdateUserPermissionsAction $updateUserPermissionsAction,
        UpdateUserTypeAction $updateUserTypeAction
    ) {
        $this->updatesUserProfileInformation = $updatesUserProfileInformation;
        $this->updateUserMenusAction = $updateUserMenusAction;
        $this->updateUserPermissionsAction = $updateUserPermissionsAction;
        $this->updateUserTypeAction = $updateUserTypeAction;
    }

    public function __invoke(User $user, array $input): User
    {
        DB::beginTransaction();

        try {
            $profile = ($this->updatesUserProfileInformation)->update($user, $input);

            $menus = ($this->updateUserMenusAction)($user, $input['menus'] ?? []);

            $type = ($this->updateUserTypeAction)($user, $input['type'] ?? null);

            $rolesAndPermissions = ($this->updateUserPermissionsAction)($user, [
                'roles' => $input['roles'] ?? '',
                'permissions' => $input['permissions'] ?? ''
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e->getMessage());
        }

        DB::commit();

        event(new UserUpdated($user));

        return $user;
    }
}
