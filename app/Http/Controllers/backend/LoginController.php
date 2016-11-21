<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
       public function login(Request $request){

          $email = $request->input('email');
          $password = $request->input('password');

         if(Auth::attempt(['email_address' => $email, 'password' => $password]))
         {
           return redirect('/backend/home');
         }
       }
      
}
