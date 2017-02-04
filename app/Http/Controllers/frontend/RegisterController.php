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
        return back()
                    ->with('duplicatedname', "Уучлаарай таны имэйл хаяг бүртгэлтэй байна")
                    ->withInput();
      }

      $messages = [
          'firstname.required' => trans('strings.first_name').' хоосон байж болохгүй',
          'lastname.required' => trans('strings.last_name').' хоосон байж болохгүй',
          'email.required' => trans('strings.email_address').' хоосон байж болохгүй',
          'password.required' => trans('strings.password').' хоосон байж болохгүй',
          'repassword.required' => trans('strings.repassword').' хоосон байж болохгүй',
          'g-recaptcha-response.required' =>'Captcha хоосон байж болохгүй',
      ];

      $validate = Validator::make($request->all(), [
        'g-recaptcha-response' => 'required',
        'firstname' => 'required',
        'lastname' => 'required',
        'email' => 'required',
        'password' => 'required',
        'repassword' => 'required'
    ], $messages);

		if ($validate->fails()) {
            return redirect('/frontend/index')
                        ->withErrors($validate)
                        ->withInput();
        }

      $status = sf_guard_user::create([
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
