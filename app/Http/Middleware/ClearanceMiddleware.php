<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ClearanceMiddleware {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {        
        if (Auth::user()->hasPermissionTo('Administer roles & permissions')) //If user has this //permission
    {
            return $next($request);
        }

        if ($request->is('transactions/create'))//If user is creating a transaction
         {
            if (!Auth::user()->hasPermissionTo('Create Transaction'))
         {
                abort('401');
            } 
         else {
                return $next($request);
            }
        }

        if ($request->is('transactions/*/edit')) //If user is editing a transaction
         {
            if (!Auth::user()->hasPermissionTo('Edit Transaction')) {
                abort('401');
            } else {
                return $next($request);
            }
        }

        if ($request->isMethod('Delete')) //If user is deleting a transaction
         {
            if (!Auth::user()->hasPermissionTo('Delete Transaction')) {
                abort('401');
            } 
         else 
         {
                return $next($request);
            }
        }

        return $next($request);
    }
}