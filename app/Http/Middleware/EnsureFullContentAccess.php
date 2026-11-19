<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureFullContentAccess
{
    /**
     * Handle an incoming request.
     * Ensures user is either Super Admin or Division Admin (blocks News-only Admin from other modules).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isSuperAdmin()) {
            return redirect()->route('admin.posts.index')->with('error', 'Akses ditolak. Akun Admin hanya memiliki akses untuk mengelola Berita & Kategori.');
        }

        return $next($request);
    }
}
