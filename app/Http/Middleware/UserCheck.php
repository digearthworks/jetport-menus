<?php

namespace App\Http\Middleware;

use App\Models\User;
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
        if ($request->user() && $request->user()->isType(User::TYPE_USER)) {
            return $next($request);
        }

        return redirect()
        ->route('index')
        ->with('flash.banner', 'You do not have access to do that.')
        ->with('flash.bannerStyle', 'danger');
    }
}
