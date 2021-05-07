<?php

namespace App\Models;

use App\Models\Traits\Attribute\IconAttribute;
use App\Models\Traits\Connection\AuthConnection;
use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Icon extends Model
{
    use AuthConnection,
        HasFactory,
        HasUuid,
        IconAttribute,
        Userstamps;

    protected $guarded = [];

    protected $appends = ['art'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
