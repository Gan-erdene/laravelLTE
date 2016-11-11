<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
use Validator;

class ProfileController extends Controller
{
    public function index(Request $request){

      $user = sf_guard_user::find(\Auth::user()->id);
      return view('frontend.edit_profile')
      ->with('user',$user);
    }
    public function action(Request $request){




        $profileName = time().'.'.$request->profileimage->getClientOriginalName();
        $coverName = time().'.'.$request->coverName->getClientOriginalName();
        $irgenii = time().'.'.$request->irgenii->getClientOriginalName();
        $khoroo = time().'.'.$request->khoroo->getClientOriginalName();
        $tsagdaa = time().'.'.$request->tsagdaa->getClientOriginalName();
        $request->profileimage->move(public_path('uploads/profileimage'), $profileName);
        $request->coverName->move(public_path('uploads/coverimage'), $coverName);
        $request->irgenii->move(public_path('uploads/irgenii'), $irgenii);
        $request->khoroo->move(public_path('uploads/khoroo'), $khoroo);
        $request->tsagdaa->move(public_path('uploads/tsagdaa'), $tsagdaa);



        $user = sf_guard_user::find(\Auth::user()->id);

        $user->register = $request->input('register');
        $user->gender = $request->input('gender') ? 1 : 2;
        $user->ndd = $request->input('ndd');
        $user->emdd = $request->input('emdd');
        $user->birthday = $request->input('birthday');
        $user->phone = $request->input('phone');
        $user->address  = $request->input('address');
        $user->profile_image = $profileName;
        $user->coverName = $coverName;
        $user->irgenii = $irgenii;
        $user->khoroo = $khoroo;
        $user->tsagdaa = $tsagdaa;
        $user->update();



      return back()
        ->with('success','Амжилттай хадгалагдлаа.')
        ->with('path',$profileName)
        ->with('path',$coverName)
        ->with('path',$irgenii)
        ->with('path',$khoroo)
        ->with('path',$tsagdaa);
    }
}
