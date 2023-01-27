<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class StudentProfile
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        //  return $next($request);
        $student = Auth::user()->getStudent;

        if (Auth::user()->role == 0) {

            if ($student) {
                return $next($request);
            } else {
                Auth::logout();
                return view('home');
            }
        } else {

            return $next($request);
        }
    }
}
