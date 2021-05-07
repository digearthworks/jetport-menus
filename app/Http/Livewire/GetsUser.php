<?php
namespace App\Http\Livewire;

use App\Models\User;

trait GetsUser
{
    public function getUser($userId, $withTrashed = false)
    {
        $query = User::query();
        if ($withTrashed) {
            $query->withTrashed();
        }
        return $query->find($userId);
    }
}
