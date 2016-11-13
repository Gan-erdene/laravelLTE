<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;

class FileController extends Controller
{
    public function index(){
      $user = sf_guard_user::find(\Auth::user()->id);
      return view('frontend.file')
      ->with('user',$user);
    }
    public function add(Request $request){
      $this->validate($request, [
            'irgenii' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'khoroo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tsagdaa' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $irgenii = time().'.'.$request->irgenii->getClientOriginalName();
        $khoroo = time().'.'.$request->khoroo->getClientOriginalName();
        $tsagdaa = time().'.'.$request->tsagdaa->getClientOriginalName();
        $request->irgenii->move(public_path('uploads/irgenii'), $irgenii);
        $request->khoroo->move(public_path('uploads/khoroo'), $khoroo);
        $request->tsagdaa->move(public_path('uploads/tsagdaa'), $tsagdaa);

        $user = sf_guard_user::find(\Auth::user()->id);
        $user->irgenii = $irgenii;
        $user->khoroo = $khoroo;
        $user->tsagdaa = $tsagdaa;
        $user->update();



      return back()
        ->with('success','Амжилттай хадгалагдлаа.')
        ->with('path',$irgenii)
        ->with('path',$khoroo)
        ->with('path',$tsagdaa);
    }
}
