<?php

namespace App\Http\Livewire;

use App\Services\RoleService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Laravel\Jetstream\InteractsWithBanner;
use Livewire\Component;

class DeleteRole extends Component
{
    use AuthorizesRequests,
        GetsRole,
        InteractsWithBanner;

    public $roleId;

    public $confirmingDeleteRole = false;

    public $listeners = ['confirmDeleteRole'];

    public function confirmDeleteRole($roleId)
    {
        $this->confirmingDeleteRole  = true;
        $this->roleId = $roleId;
        $this->dispatchBrowserEvent('showing-confirm-delete-role-modal');
    }

    public function deleteRole(RoleService $roles)
    {
        $this->authorize('onlysuperadmincanddothis');

        $roles->destroy($this->getRole($this->roleId));
        $this->emit('roleDeleted');
        $this->confirmingDeleteRole = false;
    }

    public function render()
    {
        return view('admin.roles.delete', [
            'role' => $this->getRole($this->roleId),
        ]);
    }
}
