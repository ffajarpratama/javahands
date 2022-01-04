<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //middleware buat ngecek apakah user yang login itu admin atau bukan
        //cek kalo bukan admin
        if (!auth()->user()->is_admin) {
            //kalo bukan admin return 403 (forbidden)
            abort(403);
        }
        //kalo user yang login adalah admin lanjutin proses
        return $next($request);
    }
}
