<?php

namespace App\Models;

use App\Models\Concerns\Attribute\MenuAttribute;
use App\Models\Concerns\Connection\AuthConnection;
use App\Models\Concerns\HasUuid;
use App\Models\Concerns\Method\MenuMethod;
use App\Models\Concerns\Method\PathMethod;
use App\Models\Concerns\Relationship\MenuRelationship;
use Database\Factories\MenuFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wildside\Userstamps\Userstamps;

class Menu extends Model
{
    use AuthConnection,
        CascadeSoftDeletes,
        HasFactory,
        MenuAttribute,
        MenuMethod,
        MenuRelationship,
        PathMethod,
        SoftDeletes,
        Userstamps,
        HasUuid;

    protected $cascadeDeletes = ['children'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = [];

    protected $appends = ['grid'];

    protected $with = 'icon';

    private function cleanSlug($slug)
    {
        $dirty = [
            config('ui.external_iframe_prefix'),
            config('ui.internal_iframe_prefix'),
            '#disabled_link#',
            '?externallink=',
        ];

        return ltrim(str_replace($dirty, '', $slug), '/');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return MenuFactory::new();
    }

    protected function getIconId($icon)
    {

        // Leave early if there is no icon
        if (!$icon) {
            return null;
        }

        if (is_int($icon)) {
            return Icon::query()->find($icon) ? $icon : null;
        }

        $id = (strlen($icon) > 21) ? Icon::query()->where('svg', $icon)->value('id') : Icon::query()->where('title', $icon)->value('id');

        if ($id) {
            return $id;
        }

        $iconAttributes = (strlen($icon) > 21) ? [
            'svg' => $icon,
            'source' => 'svg',
        ] : [
            'title' => $icon,
            'source' => 'FontAwesome',
            'version' => '5',
        ];


        $icon = Icon::create($iconAttributes);

        return $icon->id;
    }
}
