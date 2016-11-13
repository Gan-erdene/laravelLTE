<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ImageController extends Controller
{
  public function imageUpload()
 {
   return view('image-upload');
 }

 /**
 * Manage Post Request
 *
 * @return void
 */
 public function imageUploadPost(Request $request)
 {
   $this->validate($request, [
         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);

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
