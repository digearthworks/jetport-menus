<?php

namespace App\Turbine\Auth\Http\Middleware;

use App\Turbine\Auth\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;

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
