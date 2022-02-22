<?php

namespace App\Turbine\Menus\Models;

use App\Turbine\Concerns\CachesQueries;
use App\Turbine\Concerns\CascadeDeactivates;
use App\Turbine\Concerns\CascadeRestores;
use App\Turbine\Concerns\HasIterativeQuickSort;
use App\Turbine\Concerns\HasUuid;
use App\Turbine\Menus\Casts\SnakeCast;
use App\Turbine\Menus\Enums\MenuItemTypeEnum;
use App\Turbine\Menus\Enums\MenuTemplateEnum;
use App\Turbine\Menus\Enums\MenuTypeEnum;
use App\Turbine\Menus\QueryBuilders\MenuQueryBuilder;
use Database\Factories\MenuFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use HeaderX\BukuIcons\Concerns\HasIcon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Spatie\EloquentSortable\Sortable;

class Menu extends Model implements Sortable
{
    use HasFactory;
    use HasUuid;
    use HasIcon;
    use HasIterativeQuickSort;
    use SoftDeletes;
    use CascadeSoftDeletes;
    use CascadeDeactivates;
    use CachesQueries;
    use CascadeRestores;

    protected $guarded = [];

    protected $casts = [
        'type' => MenuTypeEnum::class,
        'template' => MenuTemplateEnum::class,
        'active' => 'bool',
        'handle' => SnakeCast::class,
    ];

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


    protected $cascadeDeletes = ['menuItems'];

    protected $cascadeRestores = ['menuItems'];

    protected $cascadeDeactivates = ['menuItems'];

    protected $cascadeReactivates = ['menuItems'];

    protected $with = ['icon'];

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

    public function getSortOrder()
    {
        return $this->ordered()->pluck('id');
    }

    public function buildSortQuery(): Builder
    {
        return static::query()->where('type', $this->type);
    }

    public function menuItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id')->onlyActive()->with('children')->ordered();
    }

    // public function links()
    // {
    //     return $this->hasMany(MenuItem::class, 'menu_id', 'id')->whereIn('type', Arr::except(MenuItemTypeEnum::toValues(), ['menu_item']));
    // }

    // public function iframes()
    // {
    //     return $this->hasMany(MenuItem::class, 'menu_id', 'id')->whereIn('type', Arr::except(MenuItemTypeEnum::toValues(), ['menu_item', 'local_links', 'external_link', 'page_link']));
    // }

    public function internalLinks()
    {
        return $this->hasMany(InternalLink::class, 'menu_id', 'id');
    }

    public function externalLinks()
    {
        return $this->hasMany(ExternalLink::class, 'menu_id', 'id');
    }

    public function InternalIframes()
    {
        return $this->hasMany(InternalIframe::class, 'menu_id', 'id');
    }

    public function externalIframes()
    {
        return $this->hasMany(ExternalIframe::class, 'menu_id', 'id');
    }

    public function authChildren()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id')->whereIn('id', Auth::user()->getAllMenuItems()->pluck('id')->toArray())->with('authChildren', 'icon', 'parentItem', 'page')->ordered();
    }
}
