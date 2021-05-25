<?php

namespace App\Models;

use App\Models\Concerns\Attribute\IconAttribute;
use App\Models\Concerns\Connection\AuthConnection;
use App\Models\Concerns\HasUuid;
use App\Models\Concerns\Scope\IconScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Icon extends Model
{
    use AuthConnection,
        HasFactory,
        HasUuid,
        IconAttribute,
        IconScope,
        Userstamps;

    protected $guarded = [];

    protected $appends = ['art', 'input'];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
