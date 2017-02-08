<?php

namespace App\Http\Middleware;

use Closure;
use Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if ($request->session()->has('user')) {
            $user= $request->session()->get('user');
            $user_ = User::where('user_id',$user->user_id )->first();
            $request->_user = $user_;
        }
        else{
             return Redirect::to('/user/create'); 
        }
        
        return $next($request);
        
    }
}
