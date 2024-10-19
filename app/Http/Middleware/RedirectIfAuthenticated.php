<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Dapatkan user yang sedang login
                $user = Auth::user();

                // Cek role pengguna dan arahkan ke halaman yang sesuai
                if ($user->role == 1) {
                    return redirect('/admin/index');
                } elseif ($user->role == 2) {
                    return redirect('/kasir/index');
                } elseif ($user->role == 0) {
                    return redirect('/user/index');
                } else {
                    // Default redirect jika role tidak dikenal
                    return redirect('/halaman/index');
                }
            }
        }

        return $next($request);
    }
}
