<?php

namespace Turbine\Concerns;

use HeaderX\BukuIcons\Models\Icon;

trait HasIcon
{
    public function icon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }
}
