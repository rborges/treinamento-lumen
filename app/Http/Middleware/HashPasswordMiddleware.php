<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Hash;

class HashPasswordMiddleware
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->filled('password')) {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            
            $request->replace($data);
        }

        return $next($request);
    }
}
