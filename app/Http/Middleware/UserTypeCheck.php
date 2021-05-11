<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class UserTypeCheck.
 */
class UserTypeCheck
{
    /**
     * @param $request
     * @param  Closure  $next
     * @param $type
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        if ($request->user()) {
            if (strpos($type, '|') !== false) {
                $types = explode('|', $type);

                foreach ($types as $t) {
                    if ($request->user()->isType($t)) {
                        return $next($request);
                    }
                }
            } elseif ($request->user()->isType($type)) {
                return $next($request);
            }
        }

        return redirect()
        ->route('dashboard')
        ->with('flash.banner', 'You do not have access to do that.')
        ->with('flash.bannerStyle', 'danger');
    }
}
