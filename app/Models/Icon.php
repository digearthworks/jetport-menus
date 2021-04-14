<?php

namespace App\Models;

use App\Models\Traits\Connection\AuthConnection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Icon extends Model
{
    use AuthConnection,
        HasFactory,
        Userstamps;

    protected $guarded = [];

    /**RELATIONS */
    /**
     * Get all of the menus that are assigned this icon.
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
