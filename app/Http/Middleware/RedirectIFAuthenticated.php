<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIFAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if(Auth::check() && Auth::user()->role == 'utilisateur'){
                    return redirect()->intended(route('dashboard'));

                }if(Auth::check() && Auth::user()->role == 'super~administrateur'){
                    return redirect()->intended(route('admin.home.dashboard'));

                }
            }
        }

        return $next($request);
    }
}
