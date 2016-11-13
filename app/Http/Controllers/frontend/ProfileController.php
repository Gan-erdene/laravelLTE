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




        $user = sf_guard_user::find(\Auth::user()->id);
        $user->last_name = $request->input('lastname');
        $user->first_name = $request->input('firstname');
        $user->email_address = $request->input('email');
        $user->register = $request->input('register');
        $user->gender = $request->input('gender');
        $user->work = $request->input('work');
        $user->ndd = $request->input('ndd');
        $user->emdd = $request->input('emdd');
        $user->birthday = $request->input('birthday');
        $user->phone = $request->input('phone');
        $user->address  = $request->input('address');
        $user->update();



      return back()
        ->with('success','Амжилттай хадгалагдлаа.')
        ;
    }
    public function Cover(Request $request)
    {


        $user = sf_guard_user::find(\Auth::user()->id);
        if(isset($request->profileimage)){
          $profileName = time().'.'.$request->profileimage->getClientOriginalName();
            $request->profileimage->move(public_path('uploads/profileimage'), $profileName);
            $user->profile_image = $profileName;
        }
        if(isset($request->coverName)){
            $coverName = time().'.'.$request->coverName->getClientOriginalName();
        $request->coverName->move(public_path('uploads/coverimage'), $coverName);

          $user->coverName = $coverName;
        }
         $user->update();



          return redirect('/frontend/home');
    }
}
