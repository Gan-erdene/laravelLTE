<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;

class FindUserController extends Controller
{
    public function index(){
      $users = sf_guard_user::all();
      return view('frontend.find_user')
        ->with('users', $users);
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'friend_request': return $this->friendRequest();
        default:break;
      }
    }

    public function friendRequest(){
      
    }
}
