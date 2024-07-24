<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfHeadOfCeit
{
   /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Assuming you have a role or type field on your User model
        if (Auth::check() && Auth::user()->position === 'ຫົວໜ້າພາກວິຊາ') {
            return $next($request);
        }

        // Redirect or abort if the user is not a teacher
        return redirect('/home')->with('error', 'You do not have teacher access.');
    }
}
