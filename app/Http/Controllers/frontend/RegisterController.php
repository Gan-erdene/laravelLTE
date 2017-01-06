<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
use Validator;
class RegisterController extends Controller
{
    public function createUser(Request $request){
      if($this->isExistUser($request)){
          return back();
      }

      $validate = Validator::make($request->all(), [
        'g-recaptcha-response' => 'required'
    ]);

		if ($validate->fails()) {
            return redirect('/frontend/index')
                        ->withErrors($validate)
                        ->withInput();
        }

      sf_guard_user::create([
          'first_name' => $request->input('firstname'),
          'last_name' => $request->input('lastname'),
          'email_address' => $request->input('email'),
          'password' => bcrypt($request->input('password')),
      ]);

      return view('frontend.signedup')->with('status','success')->with('message', 'Suc');

    }

    public function isExistUser($request){
      $user = sf_guard_user::where('email_address', $request->input('email'))->count();
      if($user > 0){
        return true;
      }else{
        return false;
      }
    }
}
