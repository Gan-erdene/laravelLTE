<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sf_guard_user;

class SalaryController extends Controller
{
    public function action(Request $request){
      switch ($request->input('action')) {
        case 'txn': return $this->createSalary($request);
        case 'info': return $this->contractInfo($request);
        default: break;
      }
    }

    public function createSalary($request){

    }

    public function contractInfo($request){
      $user_id = $request->input('user_id');
      $user = sf_guard_user::find($user_id);
      return response()->json([
        'last_name'=>$user->last_name,
        'first_name'=>$user->first_name,
        'regnum'=>$user->registr ? $user->registr : ""
      ]);
    }
}
