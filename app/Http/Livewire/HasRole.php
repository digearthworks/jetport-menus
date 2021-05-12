<?php
namespace App\Http\Livewire;

use App\Models\Role;

trait HasRole
{
    public $roleId;

    public $withTrashedRole = false;

    /**
     * @return App\Models\Role
     */
    public function getRoleProperty()
    {
        $query = Role::query();
        if ($this->withTrashedRole) {
            $query->withTrashed();
        }
        return $query->find($this->roleId);
    }
}
