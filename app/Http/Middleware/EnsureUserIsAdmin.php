<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Izinkan jika user sudah login DAN rolenya adalah 'admin' ATAU 'assessor'
        if (auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'assessor')) {
            return $next($request);
        }

        return redirect()->route('beranda')->with('error', 'Anda tidak memiliki akses ke panel ini.');
    }
}