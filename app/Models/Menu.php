<?php

namespace App\Models;

use App\Models\Concerns\Connection\AuthConnection;
use App\Models\Concerns\HasPath;
use App\Models\Concerns\HasPermissionsLabel;
use App\Models\Concerns\HasRolesLabel;
use App\Models\Concerns\HasUuid;
use App\Models\Concerns\Relationship\MenuRelationship;
use Database\Factories\MenuFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Wildside\Userstamps\Userstamps;

class Menu extends Model
{
    use AuthConnection,
        CascadeSoftDeletes,
        HasFactory,
        HasPath,
        // HasPermissionsLabel,
        // HasRoles,
        // HasRolesLabel,
        HasUuid,
        MenuRelationship,
        SoftDeletes,
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

        $id = (strlen($icon) > 21) ? Icon::query()->where('svg', $icon)->value('id') : Icon::query()->where('class', $icon)->value('id');

        if ($id) {
            return $id;
        }

        $iconAttributes = (strlen($icon) > 21) ? [
            'svg' => $icon,
            'source' => 'svg',
        ] : [
            'class' => $icon,
            'source' => 'FontAwesome',
            'version' => '5',
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

        return '/' . $prefix . config('menus.url_segments.external_link_extension') . $this->getCleanSlug();
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
    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('name', 'like', '%' . $term . '%')
                ->orWhere('link', 'like', '%' . $term . '%')
                ->orWhere('group', 'like', '%' . $term . '%');
        });
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
}
