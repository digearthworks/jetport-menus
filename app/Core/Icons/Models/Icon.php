<?php

namespace App\Core\Icons\Models;

use App\Core\Auth\Concerns\GetsAuthConnection;
use App\Core\Icons\Concerns\IconAttribute;
use App\Core\Icons\QueryBuilders\IconQueryBuilder;
use App\Core\Menus\Models\Menu;
use App\Core\Support\Concerns\HasUuid;
use Database\Factories\IconFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Wildside\Userstamps\Userstamps;

class Icon extends Model
{
    use GetsAuthConnection,
        HasFactory,
        HasUuid,
        IconAttribute,
        Userstamps;

    protected $guarded = [];

    protected $appends = ['art', 'input'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return IconFactory::new();
    }


    public function newEloquentBuilder($query): IconQueryBuilder
    {
        return new IconQueryBuilder($query);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
