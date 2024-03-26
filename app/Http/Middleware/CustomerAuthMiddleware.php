<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthMiddleware{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next){
        $customer = $request->session()->get('customer');
        if ($customer) {
            return $next($request);
        }

        return redirect()->route('customer.login')->with('error', 'You must be logged in to view this page');
    }
}

