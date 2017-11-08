<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\User;


class verified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

   //   check if logged in user is verified
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user['verified'] == 1) {

           return $next($request);

        } else {

           return redirect('verify');

        }
    }
}
