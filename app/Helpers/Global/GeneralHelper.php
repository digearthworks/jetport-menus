<?php

use Carbon\Carbon;

if (! function_exists('appName')) {
    /**
     * Helper to grab the application name.
     *
     * @return mixed
     */
    function appName()
    {
        return config('app.name', 'Jetport');
    }
}

if (! function_exists('carbon')) {
    /**
     * Create a new Carbon instance from a time.
     *
     * @param $time
     *
     * @return Carbon
     * @throws Exception
     */
    function carbon($time)
    {
        return new Carbon($time);
    }
}

if (! function_exists('homeRoute')) {
    /**
     * Return the route to the "home" page depending on authentication/authorization status.
     *
     * @return string
     */
    function homeRoute()
    {
        if (auth()->check()) {
            return 'dashboard';
        }

        return 'index';
    }
}

if (! function_exists('currentRouteHas')) {
    /**
     * Check if current url contains a given string
     * @param string|array $value
     * @return bool
     */
    function currentRouteHas($value): bool
    {
        if (is_array($value)) {
            return in_array('/'.request()->path(), $value);
        }
        return str_contains(url()->current(), $value);
    }
}
