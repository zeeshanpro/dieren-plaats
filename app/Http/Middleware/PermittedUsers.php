<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class PermittedUsers
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
        $type = Auth::user()->usertype;
        if ( Auth::user() && ( $type == 'Normal' or $type == 'Shelter' or $type == 'Breeder' ) ) {
            return $next($request);
        }
       return redirect('/')->with('error','You are not permitted to access');
    }
}
