<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if(!$user || !$user->joinRole || !in_array($user->joinRole->role, $roles)) {
            return redirect()->route('login')->with('unauthorized', 'Silahkan login terlebih daulu');
        }
        return $next($request);
    }
}
