<?php

namespace App\Models;

use App\Models\Concerns\Connection\AuthConnection;
use App\Models\Concerns\HasPath;
use App\Models\Concerns\HasUuid;
use App\Models\Concerns\Relationship\MenuRelationship;
use App\Services\Icon\FontAwesome;
use Database\Factories\MenuFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Wildside\Userstamps\Userstamps;

class Menu extends Model implements Sortable
{
    use AuthConnection,
        CascadeSoftDeletes,
        HasFactory,
        HasPath,
        HasUuid,
        MenuRelationship,
        SoftDeletes,
        SortableTrait,
        Userstamps;

    protected $cascadeDeletes = ['children'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $guarded = [];

    protected $with = 'icon';

    /**
     * remove dirty segmens from the slug
     */
    private function cleanSlug($slug): string
    {
        return ltrim(str_replace(array_values(config('menus.url_segments', [])), '', $slug), '/');
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
            return 1;
        }

        if (is_int($icon)) {
            return Icon::query()->find($icon) ? $icon : null;
        }

        $id = (strlen($icon) > 32) ? Icon::query()->where('html', $icon)->value('id') : Icon::query()->where('class', $icon)->value('id');

        if ($id) {
            return $id;
        }

        $iconAttributes = (!FontAwesome::wantsFontAwesome($icon)) ? [
            'html' => $icon,
            'source' => 'raw',
            'meta' => $this->name,
        ] : [
            'class' => $icon,
            'source' => 'FontAwesome',
            'version' => '5',
            'meta' => $this->name,
        ];

        $icon = Icon::create($iconAttributes);

        return $icon->id;
    }

    /**
     * @param $value
     * @return string
     */
    public function getNameAttribute($value): string
    {
        return ucfirst($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function getNameWithArtAttribute(): string
    {
        if (isset($this->icon->art)) {
            return "{$this->icon->art} {$this->name}";
        }
        return $this->name;
    }

    /**
     * @param $value
     * @return string
     */
    public function getMetaNameWithArtAttribute(): string
    {
        if (isset($this->icon->art)) {
            return "{$this->icon->art} {$this->handle}";
        }
        return $this->name;
    }

    /**
     * @param $value
     * @return string
     */
    public function getLinkWithArtAttribute(): string
    {
        if (isset($this->icon->art)) {
            return "{$this->icon->art} <u><a href=\"{$this->link}\">{$this->link}</a></u>";
        }
        return $this->link;
    }

    public function getPathAttribute()
    {
        return $this->path();
    }


    public function getLinkAttribute($value)
    {
        if (!$this->is_active) {
            return $this->disabled_link;
        }

        if ($this->type === 'main_menu' && !$this->menu_id > 0) {
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

    public function getInternalIframeAttribute(): string
    {
        $prefix = config('menus.url_segments.internal_iframe_prefix');

        return '/' . $prefix . $this->internal_link;
    }

    public function getExternalIframeAttribute(): string
    {
        $prefix = config('menus.url_segments.external_iframe_prefix');

        return '/' . $prefix . config('menus.url_segments.external_link_query') . $this->getCleanSlug();
    }

    public function getInternalLinkAttribute(): string
    {
        return '/' . $this->getCleanSlug();
    }

    public function getDisabledLinkAttribute(): string
    {
        return config('menus.url_segments.disabled_link_prefix') . $this->getCleanSlug();
    }

    public function getIsActiveAttribute(): bool
    {
        return ($this->attributes['active'] ?? 0) == 1;
    }

    public function getIsIFrameAttribute(): bool
    {
        return ($this->attributes['iframe'] ?? 0) == 1;
    }

    private function reloadWithChildren()
    {
        return $this->with('children', 'icon')->where('id', $this->id)->first();
    }

    public function setLinkAttribute($link)
    {
        $this->attributes['link'] = ltrim($link, '/');
    }

    public function setIconIdAttribute($icon)
    {
        $this->attributes['icon_id'] = $this->getIconId($icon);
    }

    public function setMenuIdAttribute($menuId)
    {
        // Safety Guard:
        if (!$this->find($menuId) || $this->id == $menuId) {
            $this->attributes['menu_id'] = null;

            return;
        }

        /**
         * If there is already a parent
         * just attach it to the parent
         */
        $this->attributes['menu_id'] = ($this->where('id', $menuId)->value('menu_id') ?: $menuId);
    }

    private function getCleanSlug()
    {
        return $this->cleanSlug($this->attributes['link']);
    }

    public function activate()
    {
        $this->update(['active' => 1]);
    }

    public function deactivate()
    {
        $this->update(['active' => 0]);
    }

    public function makeIframe()
    {
        $this->update(['iframe' => 1]);
    }

    public function unmakeIframe()
    {
        $this->update(['iframe' => 0]);
    }

    public function getGroupMetaForItems()
    {
        return $this->isParentMenu() ? ['group' => 'main', 'menu_id' => $this->id] : [];
    }

    public function scopeAdmin($query)
    {
        return $query->where('group', 'admin');
    }

    public function scopeApp($query)
    {
        return $query->where('group', 'app');
    }

    /**
     * Get all of the users that are assigned this menu.
     */
    public function roles()
    {
        return $this->morphedByMany(Role::class, 'menuable');
    }

    /**
     * Get all of the users that are assigned this menu.
     */
    public function users()
    {
        return $this->morphedByMany(User::class, 'menuable');
    }

    /**
     * Get all of the users that are assigned this menu.
     */
    public function bookmarks()
    {
        return $this->morphedByMany(User::class, 'menuable')->wherePivot('menuable_group', 'bookmarks');
    }

    public function usersFromRoles()
    {
        return User::role($this->roles()->pluck('name'))->get();
    }

    public function getAllUsers()
    {
        return $this->users->merge($this->usersFromRoles());
    }

    public function getAllUsersAttribute()
    {
        return $this->getAllUsers();
    }

    public function getAllUsersCountAttribute()
    {
        return $this->getAllUsers()->count();
    }

    /**
     * @param $query
     * @param $term
     *
     * @return mixed
     */
    public function scopeSearch($query, $search)
    {
        $search = is_array($search) ? $search : [$search];

        $fields = ['children' => ['name', 'link', 'group'], 'name', 'link', 'group'];


        // orWhereHas will use joins, so we'll start with fields foreach
        foreach ($fields as $relation => $field) {
            if (is_array($field)) {
                // here we join table for each relation
                $query->orWhereHas($relation, function ($q) use ($field, $search) {

                    // here we need to use nested where like: ... WHERE key = fk AND (x LIKE y OR z LIKE y)
                    $q->where(function ($q) use ($field, $search) {
                        foreach ($field as $relatedField) {
                            foreach ($search as $term) {
                                $q->orWhere($relatedField, 'like', "%{$term}%");
                            }
                        }
                    });
                });
                $query->with($relation, function ($q) use ($field, $search) {

                    // here we need to use nested where like: ... WHERE key = fk AND (x LIKE y OR z LIKE y)
                    $q->where(function ($q) use ($field, $search) {
                        foreach ($field as $relatedField) {
                            foreach ($search as $term) {
                                $q->orWhere($relatedField, 'like', "%{$term}%");
                            }
                        }
                    });
                });
            } else {
                foreach ($search as $term) {
                    $query->orWhere($field, 'like', "%{$term}%");
                }
            }
        }
        return $query;
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyDeactivated($query)
    {
        return $query->whereActive(false);
    }

    /**
     * @param $query
     *
     * @return mixed
     */
    public function scopeOnlyActive($query)
    {
        return $query->whereActive(true);
    }

    /**
     * @param $query
     * @param $type
     *
     * @return mixed
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function parent()
    {
        return $this->belongsTo(__CLASS__, 'menu_id')->with('icon', 'parent')->withTrashed();
    }

    public function getSortOrder()
    {
        return $this->ordered()->pluck('id');
    }

    public function buildSortQuery()
    {
        return static::query()->where('menu_id', $this->menu_id);
    }

    public function scopeSortGroup($query)
    {
        return $query()->where('menu_id', $this->menu_id)->where('group', $this->group);
    }

    public static function dashboard()
    {
        return self::where('name', 'Dashboard')->first();
    }
}
