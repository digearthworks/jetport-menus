<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use App\Events\User\UserUpdated;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateUserAction
{
    private UpdateUserProfileInformation $updateUserProfileInformation;

    private UpdateUserTypeAction $updateUserTypeAction;

    private UpdateUserMenusAction $updateUserMenusAction;

    private UpdateUserPermissionsAction $updateUserPermissionsAction;

    public function __construct(
        UpdateUserProfileInformation $updateUserProfileInformation,
        UpdateUserMenusAction $updateUserMenusAction,
        UpdateUserPermissionsAction $updateUserPermissionsAction,
        UpdateUserTypeAction $updateUserTypeAction
    ) {
        $this->updateUserProfileInformation = $updateUserProfileInformation;
        $this->updateUserMenusAction = $updateUserMenusAction;
        $this->updateUserPermissionsAction = $updateUserPermissionsAction;
        $this->updateUserTypeAction = $updateUserTypeAction;
    }

    public function __invoke(User $user, array $input): User
    {
        DB::beginTransaction();

        try {
            $profile = ($this->updateUserProfileInformation)->update($user, $input);

            $menus = ($this->updateUserMenusAction)($user, $input['menus'] ?? []);

            $type = ($this->updateUserTypeAction)($user, $input['type'] ?? null);

            $rolesAndPermissions = ($this->updateUserPermissionsAction)($user, [
                'roles' => $input['roles'] ?? '',
                'permissions' => $input['permissions'] ?? ''
            ]);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error($e);
        }

        DB::commit();

        event(new UserUpdated($user));

        return $user;
    }
}
