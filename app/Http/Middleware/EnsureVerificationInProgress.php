<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureVerificationInProgress
{
    /**
     * Handle an incoming request.
     * Allow access only if session has 'email' (set during registration).
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('verifying_email')) {
            return redirect()->route('register.customer.form');
        }

        return $next($request);
    }
}


