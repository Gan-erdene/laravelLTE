<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;

class HomeController extends Controller
{
  public function home(Request $request)
  {
    $user = sf_guard_user::find(\Auth::user()->id);
    return view('frontend.home')
    ->with('user',$user);
  }
}
