<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role && $user->role->name == 'admin') {
                return redirect()->route('admin.dashboard');
            } else if ($user->role && $user->role->name == 'client') {
                return redirect()->route('client.reservation');
            }
        }

        return redirect('/login');
    }
}