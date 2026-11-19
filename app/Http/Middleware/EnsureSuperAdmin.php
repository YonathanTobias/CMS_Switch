<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isSuperAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak. Fitur 1-Click Preset Switcher & Kelola Akun Admin hanya dapat diakses oleh Super Admin.');
        }

        return $next($request);
    }
}
