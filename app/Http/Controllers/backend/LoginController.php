<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
  use AuthenticatesUsers;

    public function getLogin(){
      if ( isset(\Auth::user()->id) and \Auth::user()->id) {
          return redirect('/backend/home');
      }
      return view('auth.login');
    }

     public function login(Request $request){

       $this->validateLogin($request);

     // If the class is using the ThrottlesLogins trait, we can automatically throttle
     // the login attempts for this application. We'll key this by the username and
     // the IP address of the client making these requests into this application.
     if ($this->hasTooManyLoginAttempts($request)) {
         $this->fireLockoutEvent($request);

         return $this->sendLockoutResponse($request);
     }

     $credentials = $this->credentials($request);

     if ($this->guard()->attempt($credentials, $request->has('remember'))) {
          if( \Auth::user()->is_super_admin <= 0 ){
            $this->guard()->logout();
            $request->session()->flush();
            $request->session()->regenerate();
            return redirect('/backend/login')->with("isadmin", "Уучлаарай та админ эрхтэй хэрэглэгч биш байна");
          }
         return $this->sendLoginResponse($request);
     }

     // If the login attempt was unsuccessful we will increment the number of attempts
     // to login and redirect the user back to the login form. Of course, when this
     // user surpasses their maximum number of attempts they will get locked out.
     $this->incrementLoginAttempts($request);

     return $this->sendFailedLoginResponse($request);
     }

     public function logout(Request $request)
     {
         $this->guard()->logout();

         $request->session()->flush();

         $request->session()->regenerate();

         return redirect('/backend/login');
     }

     public function username()
    {
        return 'email_address';
    }

     protected $redirectTo = '/backend/home';

}
