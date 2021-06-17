<?php

namespace App\Pages\Models;

use App\Menus\Models\Menu;
use App\Pages\QueryBuilders\PageQueryBuilder;
use App\Support\Concerns\CascadeDeactivates;
use App\Support\Concerns\HasIterativeQuickSort;
use App\Support\Concerns\HasUuid;
use Database\Factories\SitePageFactory;
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

class SitePage extends Model implements Sortable
{
    use CascadeDeactivates,
        CascadeSoftDeletes,
        HasFactory,
        HasIterativeQuickSort,
        HasUuid,
        Userstamps,
        SoftDeletes;

    protected $guarded = [];

    protected $cascadeReactivates = ['group', 'tags', 'menus'];

    protected $cascadeDeactivates = ['menus'];

    protected $cascadeDeletes = ['menus'];

    protected $cascadeRestores = ['menus'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return SitePageFactory::new();
    }

    public function newEloquentBuilder($query): PageQueryBuilder
    {
        return new PageQueryBuilder($query);
    }


    public function isActive(): bool
    {
        return $this->active ?? false;
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'site_page_id', 'id');
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(SiteTag::class, 'site_tag_id');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(SiteTag::class, 'site_taggable');
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
        return $this->body;
    }
}
