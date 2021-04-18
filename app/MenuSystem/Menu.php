<?php

namespace App\MenuSystem;

use App\MenuSystem\ModelTraits\CanBeActivated;
use App\MenuSystem\ModelTraits\CanBeOpenedInAnIframe;
use App\Models\Traits\Connection\AuthConnection;
use App\MenuSystem\ModelTraits\HasPathMethod;
use App\Models\Icon;
use App\Models\Permission;
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
        CanBeActivated,
        CanBeOpenedInAnIframe,
        HasFactory,
        HasPathMethod,
        SoftDeletes,
        Userstamps;

    protected $cascadeDeletes = ['children'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = [];

    protected $appends = ['grid'];

    protected $with = 'icon';


    public function getLabelAttribute($value)
    {
        return ucfirst($value);
    }

    public function getPathAttribute()
    {
        return $this->path();
    }


    public function getLinkAttribute($value)
    {
        if (! $this->is_active) {
            return $this->disabled_link;
        }

        if ($this->type === 'main_menu' && ! $this->menu_id > 0) {
            return $this->path();
        }

        if ($this->type === 'main_menu' && $this->menu_id > 0) {
            return $this->parent->path;
        }

        if ($this->isIframe && $this->type === 'internal_link') {
            return $this->internal_iframe;
        }

        if ($this->isIframe && $this->type === 'external_link') {
            return $this->external_iframe;
        }

        if ($this->type === 'internal_link') {
            return $this->internal_link;
        }

        if ($this->type === 'external_link') {
            return $this->cleanSlug($value);
        }

        return $value;
    }

    public function getInternalIframeAttribute()
    {
        $prefix = config('ui.internal_iframe_prefix');
        $link = $this->attributes['link'];

        return '/' . $prefix . '/' . $this->cleanSlug($link);
    }

    public function getExternalIframeAttribute()
    {
        $prefix = config('ui.external_iframe_prefix');
        $link = $this->attributes['link'];

        return '/' . $prefix . '?externallink=' . $this->cleanSlug($link);
    }

    public function getInternalLinkAttribute()
    {
        return '/' . $this->cleanSlug($this->attributes['link']);
    }

    public function getDisabledLinkAttribute()
    {
        return '#disabled_link#' . $this->cleanSlug($this->attributes['link']);
    }

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

    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'menu_id')->with('icon', 'parent');
    }

    public function isMenuIndex()
    {
        return $this->label === 'Menu Index';
    }

    public function children()
    {
        return $this->isMenuIndex() ? $this->whereNotNull('id') : $this->childrenQuery();
    }

    public function childrenQuery()
    {
        return $this->hasMany(self::class, 'menu_id')->with('icon', 'children');
    }

    public function hotlinks()
    {
        $q = $this->childrenQuery();
        $isIndex = $this->isMenuIndex();

        return $isIndex ? $q->whereNull('id') : $q->where('group', 'hotlinks');
    }

    public function items()
    {
        return $this->childrenQuery()->where('group', '!=', 'hotlink');
    }

    /**
     * Get all of the users that are assigned this menu.
     */
    public function users()
    {
        return $this->morphedByMany(\App\Models\User::class, 'menuable');
    }

    public function setLinkAttribute($link)
    {
        $this->attributes['link'] = ltrim($link, '/');
    }

    public function setIconIdAttribute($icon)
    {
        $this->attributes['icon_id'] = $this->getIconId($icon);
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

    public function getGridAttribute()
    {
        if ($this->isMenuIndex()) {
            $count = $this->whereNotNull('id')->count();
            $collection = collect($this->all());
            $rowCount = $count / 7;
            $chunks = [];
            for ($i = 0 ; $i < $rowCount; $i++) {
                $chunks[] = $collection->splice(7, 7);
            }
            $rows = array_merge($chunks, [$collection]);

            return [
                'menu' => $this->reloadWithChildren(),
                'itemsGroupMeta' => $this->getGroupMetaForItems(),
                'rows' => $rows,
            ];
        }

        if ($this->isParent()) {
            return [
                'menu' => $this->reloadWithChildren(),
                'itemsGroupMeta' => $this->getGroupMetaForItems(),
                'rows' => [
                    $this->getChildrenOfRow(1),
                    $this->getChildrenOfRow(2),
                    $this->getChildrenOfRow(3),
                    $this->getChildrenOfRow(4),
                ],
            ];
        }

        return $this->parent->grid;
    }


    public function getGroupMetaForItems()
    {
        if ($this->isParent()) {
            return ['group' => 'main', 'menu_id' => $this->id];
        }

        return [];
    }

    protected function getIconId($icon)
    {
        if (is_int($icon)) {
            return Icon::find($icon) ? $icon : null;
        }

        if (Icon::where('title', $icon)->count() < 1) {
            return (Icon::create([
                'title' => $icon,
                'source' => 'FontAwesome',
                'version' => '5',
            ]))->id;
        }

        return Icon::query()->where('title', $icon)->value('id');
    }

    private function isParent()
    {
        return $this->menu_id === null;
    }

    private function reloadWithChildren()
    {
        return $this->with('children', 'icon')->where('id', $this->id)->first();
    }

    private function getChildrenOfRow($int)
    {
        return $this->children()->where('row', $int)->with('icon')->get();
    }
}
