<?php

namespace App\Pages\Models;

use App\Menus\Models\Menu;
use App\Pages\QueryBuilders\PageQueryBuilder;
use App\Support\Concerns\CascadeDeactivates;
use App\Support\Concerns\HasIterativeQuickSort;
use App\Support\Concerns\HasUuid;
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

class Page extends Model implements Sortable
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

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class, 'page_id', 'id');
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
        return $this->body;
    }
}
