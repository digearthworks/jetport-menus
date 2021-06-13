<?php

namespace App\Models;

use App\Models\Concerns\HasIterativeQuickSort;
use App\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use Spatie\EloquentSortable\Sortable;
use Wildside\Userstamps\Userstamps;

class SitePage extends Model implements Sortable
{
    use HasFactory,
        HasIterativeQuickSort,
        HasUuid,
        Userstamps,
        SoftDeletes;

    protected $guarded = [];

    protected $cascadeReactivates = ['group', 'tags', 'menus'];

    protected $cascadeDeactivates = ['menus'];

    public function scopeOnlyDeactivated($query)
    {
        return $query->whereActive(false);
    }

    public function scopeOnlyActive($query)
    {
        return $query->whereActive(true);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($query) use ($term) {
            $query->where('title', 'like', '%' . $term . '%')
                ->orWhere('slug', 'like', '%' . $term . '%');
        });
    }

    public function scopeWelcomePages($query)
    {
        return $query->where('title', 'like', 'Welcome%')->ordered();
    }

    public function isActive(): bool
    {
        return $this->active ?? false;
    }

    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SiteTag::class, 'site_tag_id');
    }

    public function tags(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany(SiteTag::class, 'site_taggable');
    }

    public function author()
    {
        return $this->editor()->exists() ? $this->editor() : $this->creator();
    }

    public function getAuthorAttribute()
    {
        return $this->editor ?? $this->creator;
    }

    public function getContentAttribute()
    {
        return $this->body;
    }

    public function getNameAttribute(): Stringable
    {
        return Str::of($this->slug)->replace(['_', '-'], ' ')->title();
    }

    public function activate(): void
    {
        $this->update(['active' => 1]);

        foreach ($this->cascadeReactivates as $relationship) {
            $this->cascadeReactivate($relationship);
        }
    }

    public function deactivate(): void
    {
        $this->update(['active' => 0]);

        foreach ($this->cascadeDeactivates as $relationship) {
            $this->cascadeDeactivate($relationship);
        }
    }

    /**
     * Cascade deactivate the given relationship on the given mode.
     *
     * @param string  $relationship
     *
     * @return void
     */
    protected function cascadeDeactivate($relationship): void
    {
        foreach ($this->{$relationship}()->get() as $model) {
            $model->pivot ? $model->pivot->deactivate() : $model->deactivate();
        }
    }

    /**
     * Cascade deactivate the given relationship on the given mode.
     *
     * @param string  $relationship
     *
     * @return void
     */
    protected function cascadeReactivate($relationship): void
    {
        foreach ($this->{$relationship}()->get() as $model) {
            $model->pivot ? $model->pivot->activate() : $model->activate();
        }
    }

    public function menus(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Menu::class, 'site_page_id', 'id');
    }
}
