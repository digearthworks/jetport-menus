<?php

namespace App\Menus\Models;

use App\Auth\Concerns\GetsAuthConnection;
use App\Auth\Models\Role;
use App\Auth\Models\User;
use App\Menus\Concerns\MenuRelationship;
use App\Menus\Contracts\MenuLinkContract;
use App\Menus\DisabledLink;
use App\Menus\Enums\MenuGroup;
use App\Menus\Enums\MenuItemGroup;
use App\Menus\ExternalIframeLink;
use App\Menus\ExternalLink;
use App\Menus\InternalIframeLink;
use App\Menus\InternalLink;
use App\Menus\MainMenuLink;
use App\Menus\PageLink;
use App\Menus\QueryBuilders\MenuQueryBuilder;
use App\Pages\Models\SitePage;
use App\Support\Concerns\GetsIconId;
use App\Support\Concerns\HasIterativeQuickSort;
use App\Support\Concerns\HasPath;
use App\Support\Concerns\HasUuid;
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
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return MenuFactory::new();
    }

    public function newEloquentBuilder($query): MenuQueryBuilder
    {
        return new MenuQueryBuilder($query);
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
        return $this->getLink($value)->getPath();
    }

    public function getGroupAttribute($value)
    {
       return $this->getGroup($value);
    }

    public function getGroup($value)
    {
        if($this->menu_id){
            return (new MenuItemGroup($value));
        }


        return (new MenuGroup($value));
    }


    public function getLink($value): MenuLinkContract
    {
        if (isset($this->site_page_id)) {
            return (new PageLink($this));
        }

        if (!$this->is_active) {
            return (new DisabledLink($this));
        }

        if ($this->type === 'main_menu' && !$this->menu_id > 0) {
            return (new MainMenuLink($this));
        }

        if ($this->type === 'main_menu' && $this->menu_id > 0) {
            return (new MainMenuLink($this->parent));
        }

        if ($this->isIframe && $this->type === 'internal_link') {
            return (new InternalIframeLink($this));
        }

        if ($this->isIframe && $this->type === 'external_link') {
            return (new ExternalIframeLink($this));
        }

        if ($this->type === 'internal_link') {
            return (new InternalLink($this));
        }

        if ($this->type === 'external_link') {
            return (new ExternalLink($this));
        }

        return $value;
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

    public static function dashboard()
    {
        return self::where('name', 'Dashboard')->first();
    }

    public function sitePage(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SitePage::class);
    }
}
