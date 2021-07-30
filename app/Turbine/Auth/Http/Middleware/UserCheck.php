<?php

namespace App\Turbine\Auth\Http\Middleware;

use Closure;
use App\Turbine\Auth\Enums\UserTypeEnum;

/**
 * Class UserCheck.
 */
class UserCheck
{
    /**
     * @param $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->isType(UserTypeEnum::user())) {
            return $next($request);
        }

        return redirect()
        ->route('index')
        ->with('flash.banner', 'You do not have access to do that.')
        ->with('flash.bannerStyle', 'danger');
    }
}
