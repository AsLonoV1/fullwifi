<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SendMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       $role = Auth::user()->role_id;
        if($role == '2'||$role == '3'||$role == '4'){
            return $next($request);
    }else{
        return response()->json(['errors' => 'You are not Workman,Chief,Director'], 401);
    } 
    }
}
