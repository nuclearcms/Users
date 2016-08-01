<?php

namespace Nuclear\Users;


use Closure;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class GuardMiddleware {

    use AuthorizesRequests;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param string $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $this->authorize($role);

        return $next($request);
    }
}
