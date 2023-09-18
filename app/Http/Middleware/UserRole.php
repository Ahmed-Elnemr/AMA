<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;

class UserRole
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
        // return $next($request);
        if (auth()->check() && auth()->user()->getAuthIdentifier()) {

            // $authUser = User::find(\Auth::id());
         $user = User::where("id" , auth()->user()->getAuthIdentifier() )->first();

         if($user != null) {


             if($user->role_id == 'ADMIN' ) {
                 return $next($request);
             }else{
                 abort(401, 'You are not allowed to access this page');
             }




         }else{
             abort(401, 'You are not allowed to access this page');
         }


         }else{
             abort(401, 'You are not allowed to access this page');
         }



    }
}
