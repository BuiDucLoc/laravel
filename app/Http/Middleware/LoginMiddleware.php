<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         //check đã đăng nhập trước đó sau đó đăng nhập lai
         if(Auth::id() > 0){
            return redirect()->route('dashboard.index')->with('success','Đăng nhập thành công!');
        }
        return $next($request);
    }
}
