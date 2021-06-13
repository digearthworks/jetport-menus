<?php

namespace App\Listeners;

use App\Events\Role\RoleCreated;
use App\Events\Role\RoleDeleted;
use App\Events\Role\RoleUpdated;

/**
 * Class RoleEventListener.
 */
class RoleEventListener
{
    /**
     * @param $event
     *
     * @return void
     */
    public function onCreated($event): void
    {
        activity('role')
            ->performedOn($event->role)
            ->withProperties([
                'role' => [
                    'type' => $event->role->type,
                    'name' => $event->role->name,
                ],
                'permissions' => $event->role->permissions->count() ? $event->role->permissions->pluck('description')->implode(', ') : 'None',
            ])
            ->log(':causer.name created role :subject.name with permissions: :properties.permissions');
    }

    /**
     * @param $event
     *
     * @return void
     */
    public function onUpdated($event): void
    {
        activity('role')
            ->performedOn($event->role)
            ->withProperties([
                'role' => [
                    'type' => $event->role->type,
                    'name' => $event->role->name,
                ],
                'permissions' => $event->role->permissions->count() ? $event->role->permissions->pluck('description')->implode(', ') : 'None',
            ])
            ->log(':causer.name updated role :subject.name with permissions: :properties.permissions');
    }

    /**
     * @param $event
     *
     * @return void
     */
    public function onDeleted($event): void
    {
        activity('role')
            ->performedOn($event->role)
            ->log(':causer.name deleted role :subject.name');
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     *
     * @return void
     */
    public function subscribe($events): void
    {
        $events->listen(
            RoleCreated::class,
            'App\Listeners\RoleEventListener@onCreated'
        );

        $events->listen(
            RoleUpdated::class,
            'App\Listeners\RoleEventListener@onUpdated'
        );

        $events->listen(
            RoleDeleted::class,
            'App\Listeners\RoleEventListener@onDeleted'
        );
    }
}
