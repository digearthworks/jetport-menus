<?php

namespace App\Auth\Actions;

use App\Auth\Models\User;
use App\Exceptions\GeneralException;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;

class RegisterProviderAction
{
    use AuthorizesRequests;

    public function __invoke(CreateNewUser $createNewUser, $info, $provider): User
    {
        $user = $this->model::where('provider_id', $info->id)->first();

        if (! $user) {
            DB::beginTransaction();

            try {
                $user = $createNewUser([
                    'name' => $info->name,
                    'email' => $info->email,
                    'provider' => $provider,
                    'provider_id' => $info->id,
                    'email_verified_at' => now(),
                ]);
            } catch (Exception $e) {
                DB::rollBack();

                throw new GeneralException(__('There was a problem connecting to :provider', ['provider' => $provider]));
            }

            DB::commit();
        }

        return $user;
    }
}