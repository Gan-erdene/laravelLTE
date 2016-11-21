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
      if (Auth::check()) {
          return redirect('/frontend/home');
      }
      return view('frontend.login');

    }

    public function login(Request $request)
    {


      $email = $request->input('email');
      $password = $request->input('password');

     if(Auth::attempt(['email_address' => $email, 'password' => $password,'is_active' => 1]))
     {
       return redirect('/frontend/home');
     }
     else{
       return back()
         ->with('status', 'success')
         ->with('message', 'Тань эрх идэвхгүй төлөвт байна. Менежер идэвхжүүлсний дараа нэвтэрч орно уу');
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
      try{
          $socialUser = Socialite::driver('facebook')->user();
            //return $user->getEmail();
      }
      catch(\Exception $e)
      {
        return redirect('/frontend/index');
      }
      $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();
      if(!$socialProvider)
      {
          $user = sf_guard_user::firstOrcreate(
            ['email_address' => $socialUser->getEmail()],
            ['first_name' => $socialUser->getName()],
            ['profile_image' => $socialUser->getAvatar()],
          #  ['gender' => $socialUser->getGender()],
          #  ['phone' => $socialUser->getPhone()],
          # ['address' => $socialUser->getRaw()]
      #      ['work' => $socialUser->getWork()],


          );
          $user->socialProviders()->create(
            ['provider_id'=>$socialUser->getId(),'provider' => 'facebook' ]
          );
      }
      else
      $user = $socialProvider->user;
      Auth::login($user, true);
      return redirect('/frontend/home');

    //  return $user->getEmail;



    }
    public function logout(Request $request){
          Auth::logout();

          return redirect('/frontend/index');
    }



}
