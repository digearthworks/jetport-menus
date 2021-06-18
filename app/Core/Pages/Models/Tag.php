<?php

namespace App\Core\Pages\Models;

use App\Core\Support\Concerns\HasUuid;
use Database\Factories\TagFactory;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\SortableTrait;

class Tag extends Model
{
    use CascadeSoftDeletes,
        HasFactory,
        HasUuid,
        SoftDeletes,
        SortableTrait;

    protected $cascadeDeletes = ['Pages'];

    protected $cascadeDeactivates = ['Pages'];

    protected $cascadeReactivates = ['Pages'];

    protected $casts = ['active' => 'boolean'];


    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TagFactory::new();
    }

    public function taggedPages()
    {
        return $this->morphedByMany(Page::class, 'taggable')->ordered();
    }

    public function Pages()
    {
        return $this->hasMany(Page::class)->ordered();
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
}
