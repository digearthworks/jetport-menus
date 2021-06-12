<?php

namespace App\Models;

use App\Models\Concerns\HasUuid;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\SortableTrait;

class SiteTag extends Model
{
    use CascadeSoftDeletes,
        HasFactory,
        HasUuid,
        SoftDeletes,
        SortableTrait;

    protected $cascadeDeletes = ['sitePages'];

    protected $cascadeDeactivates = ['sitePages'];

    protected $cascadeReactivates = ['sitePages'];

    protected $casts = ['active' => 'boolean'];

    public function taggedSitePages()
    {
        return $this->morphedByMany(SitePage::class, 'site_taggable')->ordered();
    }

    public function sitePages()
    {
        return $this->hasMany(SitePage::class)->ordered();
    }

    public function activate()
    {
        $this->update(['active' => 1]);

        foreach ($this->cascadeReactivates as $relationship) {
            $this->cascadeReactivate($relationship);
        }
    }

    public function deactivate()
    {
        $this->update(['active' => 0]);

        foreach ($this->cascadeDeactivates as $relationship) {
            $this->cascadeDeactivate($relationship);
        }
    }

    /**
     * Cascade deactivate the given relationship on the given mode.
     *
     * @param  string  $relationship
     * @return return
     */
    protected function cascadeDeactivate($relationship)
    {
        foreach ($this->{$relationship}()->get() as $model) {
            $model->pivot ? $model->pivot->deactivate() : $model->deactivate();
        }
    }

    /**
     * Cascade deactivate the given relationship on the given mode.
     *
     * @param  string  $relationship
     * @return return
     */
    protected function cascadeReactivate($relationship)
    {
        foreach ($this->{$relationship}()->get() as $model) {
            $model->pivot ? $model->pivot->activate() : $model->activate();
        }
    }
}
