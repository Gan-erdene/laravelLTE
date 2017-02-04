<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class checkadmin
{
  use AuthenticatesUsers;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      if(!\Auth::check()){
        return redirect('/backend/login');
      }

      if( \Auth::user()->is_super_admin <= 0 ){
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/backend/login')->with("isadmin", "Уучлаарай та админ эрхтэй хэрэглэгч биш байна");
      }

      return $next($request);
    }
}
