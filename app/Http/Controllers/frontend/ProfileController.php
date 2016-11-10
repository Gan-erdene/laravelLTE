<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class ProfileController extends Controller
{
    public function index(Request $request){
      return view('frontend.edit_profile');
    }
    public function action(Request $request){
      $this->validate($request, [
            'profileimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'coverimage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $profileName = $request->profileimage->getClientOriginalName();
        $coverName = $request->coverimage->getClientOriginalName();
        $request->profileimage->move(public_path('uploads/profileimage'), $profileName);
        $request->coverimage->move(public_path('uploads/coverimage'), $coverName);

      return back()
        ->with('success','Амжилттай хадгалагдлаа.')
        ->with('path',$profileName)
        ->with('path',$coverName);
    }
}
