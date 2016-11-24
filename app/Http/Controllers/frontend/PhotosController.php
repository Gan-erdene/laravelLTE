<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
use App\Works;

class PhotosController extends Controller
{
    public function action(){

      $userid = \Auth::user()->id;
     $photos = Works::where('userid',$userid)->where('type',3)->get();

      $user = sf_guard_user::find($userid);
      $fuController = new FindUserController;
      $friends = $fuController->friendList(0, 8);
      return view('frontend.photos')
      ->with('user',$user)
      ->with('cover_right_friend',$friends)
      ->with('photos',$photos);
    }
    public function userPhotos(Request $request){
      $id = $request->input('id');
      $user = sf_guard_user::find($id);
        $user_photo =  Works::where('userid',$id)->where('type',3)->get();
        $finduser = new FindUserController;
        $cover_right_friend = $finduser->friendList(0, 8, $id);
        return view('frontend.userPhotos')
        ->with('user_photo',$user_photo)
        ->with('cover_right_friend', $cover_right_friend)
        ->with('user',$user);
    }
}
