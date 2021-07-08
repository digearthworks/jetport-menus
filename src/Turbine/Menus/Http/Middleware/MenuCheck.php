<?php

namespace Turbine\Menus\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Turbine\Concerns\InteractsWithBanner;
use Turbine\Menus\Models\MenuItem;

class MenuCheck
{
    use InteractsWithBanner;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, MenuItem $menuItem = null)
    {
        if ($request->user() && ($request->user()->isAdmin() || is_impersonating())) {
            if (
                is_impersonating() &&
                ! in_array($request->menuItem->slug, $request->user()->getAllMenuItems()->pluck('slug')->toArray())
            ) {
                $this->flashDangerBanner($request->user()->name . ' Does not have access to this menu.');
            }

            return $next($request);
        }

        if (
            $request->user() &&
            $request->menuItem &&
            in_array($request->menuItem->slug, $request->user()->getAllMenuItems()->pluck('slug')->toArray())
        ) {
            return $next($request);
        }


        return redirect()
            ->route('index')
            ->with('flash.banner', 'You do not have access to do that.')
            ->with('flash.bannerStyle', 'danger');
    }
}
