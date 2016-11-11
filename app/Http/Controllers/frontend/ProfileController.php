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
      return view('frontend.edit_profile');
    }
    public function action(Request $request){
      $this->validate($request, [
            'profileimage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'coverimage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'gender'  =>  'required',
            'register'  =>  'required|unique:posts|max:255',
            'ndd'    =>  'required|unique:posts|max:255',
            'emdd'    =>    'required|unique:posts|max:255',
            'phone'   =>    'numeric|min:3|max:8',
            'date'   =>    'required|unique:posts|max:255',
            'address'  =>  'required|unique:posts|max:255',
            'irgenii' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'khoroo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'tsagdaa' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);



        $profileName = $request->profileimage->getClientOriginalName();
        $coverName = $request->coverimage->getClientOriginalName();
        $irgenii = $request->irgenii->getClientOriginalName();
        $khoroo = $request->khoroo->getClientOriginalName();
        $tsagdaa = $request->tsagdaa->getClientOriginalName();
        $request->profileimage->move(public_path('uploads/profileimage'), $profileName);
        $request->coverimage->move(public_path('uploads/coverimage'), $coverName);
        $request->irgenii->move(public_path('uploads/irgenii'), $irgenii);
        $request->khoroo->move(public_path('uploads/khoroo'), $khoroo);
        $request->tsagdaa->move(public_path('uploads/tsagdaa'), $tsagdaa);



        $user = sf_guard_user::find($request->input('id'));

        $user->username = $request->input('register');
        $user->zone_id = $request->input('gender') ? 1 : 2;
        $user->phone2 = $request->input('ndd');
        $user->mobile_confirmation = $request->input('emdd');
        $user->phone = $request->input('phone');
        $user->created_at  = $request->input('date');
        $user->address  = $request->input('address');
        $user->profileName = $request->input('profileimage');
        $user->username_canonical = $request->input('coverimage');
        $user->email_canonical = $request->input('irgenii');
        $user->confirmation_token = $request->input('khoroo');
        $user->roles = $request->input('tsagdaa');
        $user->save();



      return back()
        ->with('success','Амжилттай хадгалагдлаа.')
        ->with('path',$profileName)
        ->with('path',$coverName)
        ->with('path',$irgenii)
        ->with('path',$khoroo)
        ->with('path',$tsagdaa);
    }
}
