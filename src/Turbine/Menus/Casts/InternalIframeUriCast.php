<?php

namespace Turbine\Menus\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Turbine\Menus\Concerns\GetsCleanUri;

class InternalIframeUriCast implements CastsAttributes
{
    use GetsCleanUri;

    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, $key, $value, $attributes)
    {
        $prefix = config('iframes.internal_iframe_prefix');

        return '/' . $prefix .'/'. $this->getCleanUri($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
