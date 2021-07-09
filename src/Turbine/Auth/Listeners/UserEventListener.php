<?php

namespace Turbine\Auth\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Events\Dispatcher;
use Turbine\Auth\Events\User\UserCreated;
use Turbine\Auth\Events\User\UserDeleted;
use Turbine\Auth\Events\User\UserDestroyed;
use Turbine\Auth\Events\User\UserLoggedIn;
use Turbine\Auth\Events\User\UserRestored;
use Turbine\Auth\Events\User\UserStatusChanged;
use Turbine\Auth\Events\User\UserUpdated;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    public function onLoggedIn($event)
    {
        if (get_class($event->user) != config('auth.providers.users.model')) {
            return;
        }

        // Update the logging in users time & IP
        $event->user->update([
            'last_login_at' => now(),
            'last_login_ip' => request()->getClientIp(),
        ]);
    }

    public function onPasswordReset($event): void
    {
        $event->user->update([
            'password_changed_at' => now(),
        ]);
    }

    public function onCreated($event): void
    {
        activity('user')
            ->performedOn($event->user)
            ->withProperties([
                'user' => [
                    'type' => $event->user->type,
                    'name' => $event->user->name,
                    'email' => $event->user->email,
                    'active' => $event->user->active,
                    'email_verified_at' => $event->user->email_verified_at,
                ],
                'roles' => $event->user->roles->count() ? $event->user->roles->pluck('name')->implode(', ') : 'None',
                'permissions' => $event->user->permissions ? $event->user->permissions->pluck('description')->implode(', ') : 'None',
            ])
            ->log(':causer.name created user :subject.name with roles: :properties.roles and permissions: :properties.permissions');
    }

    public function onUpdated($event): void
    {
        activity('user')
            ->performedOn($event->user)
            ->withProperties([
                'user' => [
                    'type' => $event->user->type,
                    'name' => $event->user->name,
                    'email' => $event->user->email,
                ],
                'roles' => $event->user->roles->count() ? $event->user->roles->pluck('name')->implode(', ') : 'None',
                'permissions' => $event->user->permissions ? $event->user->permissions->pluck('description')->implode(', ') : 'None',
            ])
            ->log(':causer.name updated user :subject.name with roles: :properties.roles and permissions: :properties.permissions');
    }

    public function onDeleted($event): void
    {
        activity('user')
            ->performedOn($event->user)
            ->log(':causer.name deleted user :subject.name');
    }

    public function onRestored($event): void
    {
        activity('user')
            ->performedOn($event->user)
            ->log(':causer.name restored user :subject.name');
    }

    public function onDestroyed($event): void
    {
        activity('user')
            ->performedOn($event->user)
            ->log(':causer.name permanently deleted user :subject.name');
    }

    public function onStatusChanged($event): void
    {
        activity('user')
            ->performedOn($event->user)
            ->log(':causer.name ' . ($event->status === 0 ? 'deactivated' : 'reactivated') . ' user :subject.name');
    }

    public function subscribe(Dispatcher $events): void
    {
        $events->listen(
            UserLoggedIn::class,
            'Turbine\Auth\Listeners\UserEventListener@onLoggedIn'
        );

        $events->listen(
            Login::class,
            'Turbine\Auth\Listeners\UserEventListener@onLoggedIn'
        );

        $events->listen(
            PasswordReset::class,
            'Turbine\Auth\Listeners\UserEventListener@onPasswordReset'
        );

        $events->listen(
            UserCreated::class,
            'Turbine\Auth\Listeners\UserEventListener@onCreated'
        );

        $events->listen(
            UserUpdated::class,
            'Turbine\Auth\Listeners\UserEventListener@onUpdated'
        );

        $events->listen(
            UserDeleted::class,
            'Turbine\Auth\Listeners\UserEventListener@onDeleted'
        );

        $events->listen(
            UserRestored::class,
            'Turbine\Auth\Listeners\UserEventListener@onRestored'
        );

        $events->listen(
            UserDestroyed::class,
            'Turbine\Auth\Listeners\UserEventListener@onDestroyed'
        );

        $events->listen(
            UserStatusChanged::class,
            'Turbine\Auth\Listeners\UserEventListener@onStatusChanged'
        );
    }
}
