<?php

namespace App\Http\Middleware;

use App\Core\Auth\Enums\UserType;
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
        if ($request->user() && $request->user()->isType(UserType::admin())) {
            return $next($request);
        }

        return redirect()
            ->route('index')
            ->with('flash.banner', 'You do not have access to do that.')
            ->with('flash.bannerStyle', 'danger');
    }
}
