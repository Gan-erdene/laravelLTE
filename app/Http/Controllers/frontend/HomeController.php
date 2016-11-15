<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
use App\Section;

class HomeController extends Controller
{
  public function home(Request $request)
  {
    $user = sf_guard_user::find(\Auth::user()->id);
    $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
    return view('frontend.home')
    ->with('user',$user)
    ->with('sections',$sections);
  }

  public function action(Request $request)
  {
      $post = new post;
      $post->body = $request->input('fulltext');
      if(isset($request->upload)){
          $upload = time().'.'.$request->upload->getClientOriginalName();
      $request->upload->move(public_path('uploads/post'), $upload);

     $post->image = $upload;
      }
      $post->user_id = \Auth::user()->id;
      $post->save();

      return back();
  }
  public function cv(Request $request)
  {

  }
}
