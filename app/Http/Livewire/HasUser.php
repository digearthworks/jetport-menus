<?php
namespace App\Http\Livewire;

use App\Models\User;

trait HasUser
{
    public $userId;

    public $withTrashedUser = false;

    /**
     * @return App\Models\User
     */
    public function getUserProperty()
    {
        $query = User::query();
        if ($this->withTrashedUser) {
            $query->withTrashed();
        }
        return $query->find($this->userId);
    }
}
