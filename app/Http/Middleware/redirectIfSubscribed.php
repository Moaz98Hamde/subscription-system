<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class redirectIfSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->subscribed(env('PRODUCT_NAME'))) {
            // This user is not a paying customer...
            return redirect(route('subscribed'));
        }

        return $next($request);
    }
}
