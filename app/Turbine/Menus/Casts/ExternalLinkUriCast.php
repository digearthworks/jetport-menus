<?php

namespace App\Turbine\Menus\Casts;

use App\Turbine\Menus\Concerns\GetsCleanUri;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ExternalLinkUriCast implements CastsAttributes
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
        return $this->getCleanUri($value);
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
        return $this->getCleanUri($value);
    }
}
