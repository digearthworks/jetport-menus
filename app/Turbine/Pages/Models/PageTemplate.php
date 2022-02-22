<?php

namespace App\Turbine\Pages\Models;

use App\Turbine\Concerns\HasIterativeQuickSort;
use App\Turbine\Concerns\HasUuid;
use Database\Factories\PageTemplateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Wildside\Userstamps\Userstamps;

class PageTemplate extends Model implements Sortable
{
    use HasFactory;
    use HasUuid;
    use HasIterativeQuickSort;
    use SoftDeletes;
    use Userstamps;

    protected $guarded = [];

    protected $with = ['editor', 'creator'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PageTemplateFactory::new();
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', $term.'%');
    }

    public function page()
    {
        return $this->hasMany(Page::class, 'template_id', 'id');
    }

    public function getAuthorAttribute()
    {
        return $this->editor ?? $this->creator;
    }
}
