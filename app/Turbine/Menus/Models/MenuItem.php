<?php

namespace App\Turbine\Menus\Models;

use App\Turbine\Auth\Models\Role;
use App\Turbine\Auth\Models\User;
use App\Turbine\Concerns\CachesQueries;
use App\Turbine\Concerns\CascadeDeactivates;
use App\Turbine\Concerns\CascadeRestores;
use App\Turbine\Concerns\HasChildren;
use App\Turbine\Concerns\HasIterativeQuickSort;
use App\Turbine\Concerns\HasUuid;
use App\Turbine\Menus\Casts\SnakeCast;
use App\Turbine\Menus\Contracts\HasPath;
use App\Turbine\Menus\Enums\MenuItemTemplateEnum;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;
use App\Turbine\Menus\QueryBuilders\MenuItemQueryBuilder;
use App\Turbine\Pages\Models\Page;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Database\Factories\MenuItemFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use HeaderX\BukuIcons\Concerns\HasIcon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\EloquentSortable\Sortable;

class MenuItem extends Model implements Sortable, HasPath
{
    use HasChildren;
    use HasFactory;
    use HasUuid;
    use HasIcon;
    use HasIterativeQuickSort;
    use SoftDeletes;
    use Sluggable;
    use SluggableScopeHelpers;
    use CascadeRestores;
    use CascadeDeactivates;
    use CachesQueries;
    use CascadeSoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'type' => MenuItemTypeEnum::class,
        'template' => MenuItemTemplateEnum::class,
        'active' => 'bool',
        'handle' => SnakeCast::class,
    ];

    // protected $childTypes = [
    //     'local_link' => InternalLink::class,
    //     'external_link' => ExternalLink::class,
    //     'page_link' => PageLink::class,
    //     'menu_link' => MenuLink::class,
    //     'internal_iframe' => InternalIframe::class,
    //     'external_iframe' => ExternalIframe::class,
    //     'menu_item' => MenuItem::class,
    // ];

    protected $cascadeDeletes = ['allChildren'];

    protected $cascadeRestores = ['allChildren', 'parentItem', 'menu'];

    protected $cascadeDeactivates = ['allChildren'];

    protected $cascadeReactivates = ['allChildren', 'parentItem', 'menu'];

    protected $parentalGlobalScopeFunctionName = 'ParentalInheritance';

    protected $with = ['parentItem', 'icon', 'menu'];

    public function newEloquentBuilder($query): MenuItemQueryBuilder
    {
        return new MenuItemQueryBuilder($query);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }

    public function getRouteKeyName(): string
    {
        return $this->getSlugKeyName();
    }

    public function getPath()
    {
        return '/'.config('turbine.menus.route_prefix').'/'.$this->slug;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return MenuItemFactory::new();
    }

    public function restore()
    {
        //sanity check
        if ($this->{$this->getDeletedAtColumn()} === null) {
            return false;
        }

        // If the restoring event does not return false, we will proceed with this
        // restore operation. Otherwise, we bail out so the developer will stop
        // the restore totally. We will clear the deleted timestamp and save.
        if ($this->fireModelEvent('restoring') === false) {
            return false;
        }

        $this->{$this->getDeletedAtColumn()} = null;

        // Once we have saved the model, we will fire the "restored" event so this
        // developer will do anything they need to after a restore operation is
        // totally finished. Then we will return the result of the save call.
        $this->exists = true;

        $result = $this->save();

        $this->fireModelEvent('restored', false);

        foreach ($this->cascadeRestores as $relationship) {
            $this->cascadeRestore($relationship);
        }
    }

    public function getUriWithArtAttribute()
    {
        $name = $this->icon->name ?? 'carbon-no-image-32';

        return '<div class="flex">'.svg($name, 'w-4 h-4')->toHtml()."<u><a href=\"{$this->uri}\">{$this->uri}</a></u></div>";
    }

    public function getNameWithArtAttribute(): string
    {
        if (isset($this->icon->art)) {
            return "{$this->icon->art} {$this->name}";
        }

        return $this->name;
    }

    public function getHandleWithArtAttribute(): string
    {
        if (isset($this->icon->art)) {
            return "{$this->icon->art} {$this->handle}";
        }

        return $this->name;
    }

    public function getSortOrder()
    {
        return $this->ordered()->pluck('id');
    }

    public function buildSortQuery(): Builder
    {
        return static::query()->where('parent_id', $this->parent_id)->where('menu_id', $this->menu_id);
    }

    public function children()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('children', 'icon', 'parentItem', 'page', 'menu')->onlyActive()->ordered();
    }

    public function allChildren()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('children', 'icon', 'parentItem', 'page', 'menu')->ordered();
    }

    public function authChildren()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->whereIn('id', Auth::user()->getAllMenuItems()->pluck('id')->toArray())->with('authChildren', 'icon', 'parentItem', 'page')->ordered();
    }

    public function links()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->whereIn('type', Arr::except($this->childTypes, ['menu_item']));
    }

    public function iframes()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->whereIn('type', Arr::except($this->childTypes, ['menu_item', 'local_links', 'external_link', 'page_link']));
    }

    public function internalLink()
    {
        return $this->hasMany(InternalLink::class, 'parent_id', 'id');
    }

    public function pageLinks()
    {
        return $this->hasMany(PageLink::class, 'parent_id', 'id');
    }

    public function externalLinks()
    {
        return $this->hasMany(ExternalLink::class, 'parent_id', 'id');
    }

    public function InternalIframes()
    {
        return $this->hasMany(InternalIframe::class, 'parent_id', 'id');
    }

    public function externalIframes()
    {
        return $this->hasMany(ExternalIframe::class, 'parent_id', 'id');
    }

    public function parentItem()
    {
        return $this->belongsTo(self::class, 'parent_id', 'id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
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
}
