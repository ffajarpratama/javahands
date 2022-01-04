<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //middleware buat ngecek apakah user yang login itu admin atau bukan
        //cek kalo admin
        if (auth()->user()->is_admin) {
            //kalo admin redirect ke url: /admin/dashboard
            return redirect()->route('admin.dashboard');
        }
        //kalo user yang login itu bukan admin, lanjutin proses
        return $next($request);
    }
}
