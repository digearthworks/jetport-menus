<?php

namespace App\Turbine\Menus\Models;

use Database\Factories\PageLinkFactory;
use HeaderX\BukuIcons\Concerns\HasIcon;
use App\Turbine\Concerns\CachesQueries;
use App\Turbine\Concerns\HasParent;
use App\Turbine\Pages\Models\Page;

class PageLink extends MenuItem
{
    use CachesQueries;
    use HasParent;
    use HasIcon;

    protected $with = ['page'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PageLinkFactory::new();
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id', 'id');
    }

    public function getUriAttribute($value)
    {
        return $this->page->getPath();
    }
}
