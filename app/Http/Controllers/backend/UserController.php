<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;

class UserController extends Controller
{
    public function index(){
      $list = sf_guard_user::all();
      return view('backend.user.userList')
      ->with('list', $list);
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'confirm': return $this->confirm($request);
        case 'inactive': return $this->inactive($request);
        default: break;
      }
    }

    public function confirm($request){
        $userid = $request->input('userid');
        $user = sf_guard_user::find($userid);
        $user->is_active = 1;
        $user->save();
        return back()
          ->with('status', 'success')
          ->with('message', 'Бүртгэлийг амжилттай баталгаажуулав');
    }
    public function inactive($request){
        $userid = $request->input('userid');
        $user = sf_guard_user::find($userid);
        $user->is_active = '2';
        $user->save();
        return back()
          ->with('status', 'success')
          ->with('message', 'Хэрэглэгч идэвхгүй болсон');
    }
}
