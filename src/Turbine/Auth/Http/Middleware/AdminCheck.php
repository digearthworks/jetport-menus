<?php

namespace Turbine\Auth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Turbine\Auth\Enums\UserTypeEnum;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->isType(UserTypeEnum::admin())) {
            return $next($request);
        }

        return redirect()
            ->route('index')
            ->with('flash.banner', 'You do not have access to do that.')
            ->with('flash.bannerStyle', 'danger');
    }
}
