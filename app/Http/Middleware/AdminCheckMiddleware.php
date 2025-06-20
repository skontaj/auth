<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // ako korisnik nije admin vrati ga na dashboard
        $role = Auth()->user()->role ?? null;

        if ($role !== 'admin') {
            return redirect()->route('welcome')->with('error', 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
