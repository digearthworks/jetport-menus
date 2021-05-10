<?php
namespace App\Http\Livewire;

use App\Models\Role;

trait GetsRole
{
    public function getRole($roleId, $withTrashed = false)
    {
        $query = Role::query();
        if ($withTrashed) {
            $query->withTrashed();
        }
        return $query->find($roleId);
    }
}
