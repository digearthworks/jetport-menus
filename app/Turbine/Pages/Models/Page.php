<?php

namespace App\Turbine\Pages\Models;

use App\Turbine\Concerns\CachesQueries;
use App\Turbine\Concerns\CascadeDeactivates;
use App\Turbine\Concerns\HasIterativeQuickSort;
use App\Turbine\Concerns\HasUuid;
use App\Turbine\Menus\Contracts\HasPath;
use App\Turbine\Menus\Models\MenuItem;
use App\Turbine\Pages\QueryBuilders\PageQueryBuilder;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Database\Factories\PageFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Spatie\EloquentSortable\Sortable;
use Wildside\Userstamps\Userstamps;

class Page extends Model implements Sortable, HasPath
{
    use CascadeDeactivates;
    use CascadeSoftDeletes;
    use HasFactory;
    use HasIterativeQuickSort;
    use HasUuid;
    use Userstamps;

    // CachesQueries,
    use SoftDeletes;
    use Sluggable;
    use SluggableScopeHelpers;

    protected $guarded = [];

    protected $cascadeReactivates = ['group', 'tags', 'menuItems'];

    protected $cascadeDeactivates = ['menuItems'];

    protected $cascadeDeletes = ['menuItems'];

    protected $cascadeRestores = ['menuItems'];

    protected $with = ['editor', 'creator'];

    public function sluggable(): array
    {
        return ['slug'];
    }

    public function getRouteKeyName(): string
    {
        return $this->getSlugKeyName();
    }

    public function getPath()
    {
        return '/'.config('turbine.pages.route_prefix').'/'.$this->slug;
    }

    public function template()
    {
        return $this->belongsTo(PageTemplate::class, 'template_id', 'id');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PageFactory::new();
    }

    public function newEloquentBuilder($query): PageQueryBuilder
    {
        return new PageQueryBuilder($query);
    }

    public function isActive(): bool
    {
        return $this->active ?? false;
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'page_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Tag::class, 'tag_id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function author()
    {
        return $this->editor()->exists() ? $this->editor() : $this->creator();
    }

    public function getNameAttribute(): Stringable
    {
        return Str::of($this->slug)->replace(['_', '-'], ' ')->title();
    }

    public function getAuthorAttribute()
    {
        return $this->editor ?? $this->creator;
    }

    public function getContentAttribute()
    {
        return $this->html;
    }
}
