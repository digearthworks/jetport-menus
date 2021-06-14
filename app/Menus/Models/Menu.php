<?php

namespace App\Menus\Models;

use App\Auth\Concerns\GetsAuthConnection;
use App\Support\Concerns\HasIterativeQuickSort;
use App\Support\Concerns\HasPath;
use App\Support\Concerns\HasUuid;
use App\Auth\Models\Role;
use App\Pages\Models\SitePage;
use App\Auth\Models\User;
use App\Menus\Concerns\MenuRelationship;
use App\Support\Concerns\GetsIconId;
use Database\Factories\MenuFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Wildside\Userstamps\Userstamps;

class Menu extends Model implements Sortable
{
    use GetsAuthConnection,
        CascadeSoftDeletes,
        GetsIconId,
        HasFactory,
        HasIterativeQuickSort,
        HasPath,
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
    public function getHandleWithArtAttribute(): string
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

    public function getPathAttribute(): string
    {
        return $this->path();
    }


    public function getLinkAttribute($value)
    {
        if (isset($this->site_page_id)) {
            return config('menus.url_segments.pages_prefix') . $this->sitePage->slug;
        }

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

    private function reloadWithChildren(): ?object
    {
        return $this->with('children', 'icon')->where('id', $this->id)->first();
    }

    public function setLinkAttribute($link): void
    {
        $this->attributes['link'] = ltrim($link, '/');
    }

    public function setIconIdAttribute($icon): void
    {
        $this->attributes['icon_id'] = $this->getIconId($icon, $this->name);
    }

    /**
     * @return void
     */
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

    private function getCleanSlug(): string
    {
        return $this->cleanSlug($this->attributes['link']);
    }

    public function activate(): void
    {
        $this->update(['active' => 1]);
    }

    public function deactivate(): void
    {
        $this->update(['active' => 0]);
    }

    public function makeIframe(): void
    {
        $this->update(['iframe' => 1]);
    }

    public function unmakeIframe(): void
    {
        $this->update(['iframe' => 0]);
    }

    public function getGroupMetaForItems(): array
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

    public function roles(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphedByMany(Role::class, 'menuable');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\MorphToMany
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

    public function buildSortQuery(): Builder
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

    public function sitePage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SitePage::class);
    }
}
