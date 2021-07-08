<?php

namespace Turbine\Auth\Actions;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Spatie\Enum\Laravel\Rules\EnumRule;
use Turbine\Auth\Enums\UserTypeEnum;
use Turbine\Auth\Events\User\UserUpdated;
use Turbine\Auth\Models\User;
use Validator;

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
        Validator::make($input, [
            'type' => [new EnumRule(UserTypeEnum::class)],
            'name' => ['string'],
            'email' => ['email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'active' => ['integer'],
            'roles' => ['array'],
            'permissions' => ['array'],
            'menuItems' => ['array'],
            'send_confirmation_email' => ['integer'],
            'email_verified' => ['integer'],
        ])->validateWithBag('updatedUserForm');

        DB::beginTransaction();

        try {
            $profile = ($this->updatesUserProfileInformation)->update($user, $input);

            $menus = ($this->updateUserMenusAction)($user, $input['menuItems'] ?? []);

            $type = ($this->updateUserTypeAction)($user, $input['type'] ?? null);

            $rolesAndPermissions = ($this->updateUserPermissionsAction)($user, [
                'roles' => $input['roles'] ?? '',
                'permissions' => $input['permissions'] ?? '',
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
