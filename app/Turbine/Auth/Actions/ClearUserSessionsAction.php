<?php

namespace App\Turbine\Auth\Actions;

use App\Models\User;
use App\Turbine\Auth\Events\User\UserUpdated;
use App\Turbine\Exceptions\GeneralException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClearUserSessionsAction
{
    public function __invoke(User $user): User
    {
        DB::beginTransaction();

        try {
            if (Auth::user()->isAdmin() && Auth::user()->id != $user->id) {
                $user->update([
                    'to_be_logged_out' => true,
                ]);
            }

            DB::connection(config('session.connection'))->table(config('session.table', 'sessions'))
                ->where('user_id', $user->id)
                ->delete();
        } catch (Exception $e) {
            DB::rollBack();

            throw new GeneralException(__('There was a problem clearing this user\'s sessions. Please try again.'));
        }

        event(new UserUpdated($user));

        DB::commit();

        return $user;
    }
}
