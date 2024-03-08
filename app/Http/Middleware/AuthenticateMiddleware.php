<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //kiểm tra khi chưa đăng nhập nhưng vô link admin
        if(Auth::user() == null){
            return redirect()->route('auth.admin')->with('error','Vui lòng đăng nhập tài khoản!');
        }
        return $next($request);
    }
}
