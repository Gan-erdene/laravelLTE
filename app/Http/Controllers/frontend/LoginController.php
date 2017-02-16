<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Socialite;
use App\SocialProvider;
use App\sf_guard_user;

class LoginController extends Controller
{
    public function index(Request $request)
    {
      if ( isset(\Auth::user()->id) and \Auth::user()->id) {
          return redirect('/frontend/newsfeed');
      }
      return view('frontend.login');

    }

    public function login(Request $request)
    {

      $email = $request->input('email');
      $password = $request->input('password');

     if(Auth::attempt(['email_address' => $email, 'password' => $password]))
     {
       return redirect('/frontend/newsfeed');
     }
     else{
       return back()
         ->with('status', 'warning')
         ->with('message', 'Уучлаарай таны нэвтрэх нэр эсвэл нууц үг буруу байна');
     }
    }
    public function redirectToProvider()
    {
     return Socialite::driver('facebook')->redirect();
    }

 /**
  * Obtain the user information from GitHub.
  *
  * @return Response
  */
 public function handleProviderCallback()
  {
		
          $socialUser = Socialite::driver('facebook')->user();
		  //return dd($socialUser);
		  if($socialUser){
			  $email = $socialUser->getEmail();
			  $user = sf_guard_user::where("email_address",$email)->first();
			  if($user){
				 Auth::loginUsingId($user->id, true); 
			  }else{
				  $newuser = new sf_guard_user();
				  $newuser->email_address = $socialUser->getEmail();
				  $newuser->first_name = $socialUser->getName();
				  $newuser->save();
				   Auth::loginUsingId($newuser->id, true); 
			  }
			  
			  return redirect('/frontend/newsfeed');
		  }
    }
    public function logout(Request $request){
          Auth::logout();

          return redirect('/frontend/index');
    }



}
