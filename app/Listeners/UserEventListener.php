<?php

namespace App\Listeners;

use App\Events\User\UserCreated;
use App\Events\User\UserDeleted;
use App\Events\User\UserDestroyed;
use App\Events\User\UserLoggedIn;
use App\Events\User\UserRestored;
use App\Events\User\UserStatusChanged;
use App\Events\User\UserUpdated;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\PasswordReset;
use Str;
use Wink\WinkAuthor;

/**
 * Class UserEventListener.
 */
class UserEventListener
{
    /**
     * @param $event
     */
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

    /**
     * @param $event
     */
    public function onPasswordReset($event)
    {
        $event->user->update([
            'password_changed_at' => now(),
        ]);
    }

    /**
     * @param $event
     */
    public function onCreated($event)
    {
        if (config('template.cms.cms') && config('template.cms.driver') === 'wink') {
            $this->createWinkAuthor($event);
        }

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

    /**
     * @param $event
     */
    public function onUpdated($event)
    {
        if (config('template.cms.cms') && config('template.cms.driver') === 'wink') {
            $this->createWinkAuthor($event);
        }

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

    /**
     * @param $event
     */
    public function onDeleted($event)
    {
        if (config('template.cms.cms') && config('template.cms.driver') === 'wink') {
            $this->deleteWinkAuthor($event);
        }

        activity('user')
            ->performedOn($event->user)
            ->log(':causer.name deleted user :subject.name');
    }

    /**
     * @param $event
     */
    public function onRestored($event)
    {
        if (config('template.cms.cms') && config('template.cms.driver') === 'wink') {
            $this->createWinkAuthor($event);
        }

        activity('user')
            ->performedOn($event->user)
            ->log(':causer.name restored user :subject.name');
    }

    /**
     * @param $event
     */
    public function onDestroyed($event)
    {
        if (config('template.cms.cms') && config('template.cms.driver') === 'wink') {
            $this->deleteWinkAuthor($event);
        }

        activity('user')
            ->performedOn($event->user)
            ->log(':causer.name permanently deleted user :subject.name');
    }

    /**
     * @param $event
     */
    public function onStatusChanged($event)
    {
        if (config('template.cms.cms') && config('template.cms.driver') === 'wink') {
            $event->status === 0 ? $this->deleteWinkAuthor($event) : $this->createWinkAuthor($event);
        }

        activity('user')
            ->performedOn($event->user)
            ->log(':causer.name ' . ($event->status === 0 ? 'deactivated' : 'reactivated') . ' user :subject.name');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            UserLoggedIn::class,
            'App\Listeners\UserEventListener@onLoggedIn'
        );

        $events->listen(
            Login::class,
            'App\Listeners\UserEventListener@onLoggedIn'
        );

        $events->listen(
            PasswordReset::class,
            'App\Listeners\UserEventListener@onPasswordReset'
        );

        $events->listen(
            UserCreated::class,
            'App\Listeners\UserEventListener@onCreated'
        );

        $events->listen(
            UserUpdated::class,
            'App\Listeners\UserEventListener@onUpdated'
        );

        $events->listen(
            UserDeleted::class,
            'App\Listeners\UserEventListener@onDeleted'
        );

        $events->listen(
            UserRestored::class,
            'App\Listeners\UserEventListener@onRestored'
        );

        $events->listen(
            UserDestroyed::class,
            'App\Listeners\UserEventListener@onDestroyed'
        );

        $events->listen(
            UserStatusChanged::class,
            'App\Listeners\UserEventListener@onStatusChanged'
        );
    }

    protected function createWinkAuthor($event)
    {
        if (!$event->user->hasRole(config('template.auth.access.role.admin'))) {
            return;
        }
        WinkAuthor::firstOrCreate([
            'email' => $event->user->email,
        ], [
            'id' => (string) Str::uuid(),
            'name' => $event->user->name,
            'slug' => Str::slug($event->user->name),
            'bio' => 'This is me.',
            'email' => $event->user->email,
            'password' => $event->user->password,
        ]);
    }

    protected function deleteWinkAuthor($event)
    {
        $author = WinkAuthor::where([
            'email' => $event->user->email,
        ])->first();

        if ($author) {
            $author->delete();
        }
    }
}
