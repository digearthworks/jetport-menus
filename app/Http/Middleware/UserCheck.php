<?php

namespace App\Http\Middleware;

use App\Core\Auth\Enums\UserType;
use App\Core\Auth\Models\User;
use Closure;

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
        if ($request->user() && $request->user()->isType(UserType::user())) {
            return $next($request);
        }

        return redirect()
        ->route('index')
        ->with('flash.banner', 'You do not have access to do that.')
        ->with('flash.bannerStyle', 'danger');
    }
}
