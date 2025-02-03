<?php

// namespace App\Http\Middleware;

// use Closure;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Http\Request;
// use Illuminate\Http\Response;

// class CheckAdmin
// {

//     public function handle($request, Closure $next)
//     {
//         if (Auth::guard('admin')->check() && Auth::guard('admin')->user()->role === 'admin') {
//             return $next($request);
//         }

//         return redirect('/')->with('error', 'Access denied.');
//     }

//     // public function handle($request, Closure $next)
//     // {
//     //     if (Auth::check() && Auth::user()->is_admin && Auth::user()->status === 'verified') {
//     //         return $next($request);
//     //     }

//     //     return redirect('/admin/login')->withErrors(['You must be a verified admin to access this page.']);
//     // }
// }