<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(Request $request)
    {
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
    public function logout(Request $request){
          Auth::logout();

          return redirect('/frontend/index');
    }



}
