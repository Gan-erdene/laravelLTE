<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
class RegisterController extends Controller
{
    public function createUser(Request $request){
      if($this->isExistUser($request)){
          return null;
      }


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
