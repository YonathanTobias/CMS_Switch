<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn () => route('admin.login'));
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Illuminate\Session\TokenMismatchException $e, $request) {
            if ($request->is('admin/*') || $request->is('login')) {
                return redirect()->route('admin.login')->with('error', 'Sesi keamanan (CSRF Token) telah kedaluwarsa. Silakan coba login kembali.');
            }
            return back()->with('error', 'Sesi Anda telah kedaluwarsa. Silakan muat ulang halaman.');
        });
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\HttpException $e, $request) {
            if ($e->getStatusCode() === 419) {
                if ($request->is('admin/*') || $request->is('login')) {
                    return redirect()->route('admin.login')->with('error', 'Sesi login telah kedaluwarsa. Silakan coba login kembali.');
                }
                return back()->with('error', 'Sesi Anda telah kedaluwarsa. Silakan muat ulang halaman.');
            }
        });
    })->create();
