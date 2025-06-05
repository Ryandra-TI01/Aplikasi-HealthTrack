<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockUserFromAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (
            $user &&
            $user->hasRole('user') &&
            $request->is('admin') || $request->is('admin/*')
        ) {
            return redirect('/dashboard')->with('error', 'Kamu tidak punya akses ke halaman admin.');
        }

        return $next($request);
    }
}
