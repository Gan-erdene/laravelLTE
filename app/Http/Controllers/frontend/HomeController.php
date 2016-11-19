<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
use App\Section;
use App\post;
use App\Category;
use App\sv;
use App\svcategories;
use Validator;
use App\Like;
use App\Works;
use Image;

class HomeController extends Controller
{
  public function home(Request $request)
  {
    $user = sf_guard_user::find(\Auth::user()->id);
    $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
    $posts = Works::where('userid',\Auth::user()->id)->orderBy('created_at','desc')->get();

    return view('frontend.home')
    ->with('user',$user)
    ->with('sections',$sections)
    ->with('posts',$posts);
  }
  public function test(Request $request)
  {
    return view('frontend.test');
  }
  public function postLikePost(Request $request)
  {
   $post_id = $request->input('postId');
   $post = Works::find($post_id);
   if(!$post){
     return response()->json(['test'=>"post uuseegui bna"]);
   }

    $user = \Auth::user();
    $like =  Like::where('user_id', $user->id)->where('post_id', $post_id)->first();

    if($like){
        $like->delete();
        $like_count =  Like::where('post_id', $post_id)->count();
        return response()->json(['status'=>'success', 'message'=>"<i class='fa fa-thumbs-o-up'></i>"."like",'like_count'=>$like_count]);
    }else{
      $like = new Like;
    }

    $like->user_id = $user->id;
    $like->post_id = $post->id;
    $like->save();
      $like_count =  Like::where('post_id', $post_id)->count();
    return response()->json(['status'=>'success', 'message'=>"<i class='fa fa-thumbs-o-up'></i>"."unlike",'like_count'=>$like_count]);

  }

  public function post(Request $request)
  {
      $post = new Works;
      $post->project_name = 'Post';
      $post->startdate = '2016-11-19 03:20:00';
      $post->enddate = '2016-11-19 03:20:00';

      $post->reference = $request->input('fulltext');
      if(isset($request->upload)){
        $upload = $request->file('upload');
              $input['upload'] = time().'.'.$upload->getClientOriginalName();
              $destinationPath = public_path('uploads/post');
              $img = Image::make($upload->getRealPath());
              $img->resize(660, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
          })->save($destinationPath.'/'.$input['upload']);
        $post->filename = $input['upload'];
      }

      $post->type = '3';
      $post->userid = \Auth::user()->id;
      $post->save();

      return back();
  }
  public function action(Request $request){
    switch ($request->input('action')) {
      case 'category': return $this->getCategoryBySetion($request);
      case 'creatework' : return $this->createWork($request);
      case 'delete': return $this->deleteWork($request->input('workid'));
      case 'save': return $this->saveWork($request);
      default: break;
    }
  }

  public function getCategoryBySetion($request){
    $categories = Category::where('section_id', $request->input('section_id'))->orderBy('order_id', 'asc')->get();
    $view = view('category.checkbox_cat',['categories'=>$categories]);
    return response()->json(['html'=>$view->render()]);
  }

  public function createWork($request){

    $validator = Validator::make($request->all(), [
        'title' => 'required',
        'price' => 'required'
    ], $this->messages());

    if ($validator->fails()) {
        return back()
                    ->withErrors($validator, 'add');
    }

    $title = $request->input('title');
    $body = $request->input('body');
    $price = $request->input('price');
    $sv = new Works;
    $sv->startdate = '2016-11-19 03:20:00';
    $sv->enddate = '2016-11-19 03:20:00';
    $sv->project_name = $title;
    $sv->reference = $body;
    if($price)
    $sv->price = $price;
    $sv->type = '2';

    if(isset($request->imagename)){
      $upload = $request->file('imagename');
            $input['imagename'] = time().'.'.$imagename->getClientOriginalName();
            $destinationPath = public_path('uploads/post');
            $img = Image::make($upload->getRealPath());
            $img->resize(660, null, function ($constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
        })->save($destinationPath.'/'.$input['imagename']);
      $post->filename = $input['imagename'];
    }
    $sv->is_active = 1;
    $sv->userid = \Auth::user()->id;
    $status = $sv->save();
    if($status){
        $this->createWorkCategory($sv->id, $request->input('categories'));
        return back()->with('status', 'success')->with('message', trans('strings.add_work_success'));
    }else{
        return back()->with('status', 'error')->with('message', trans('strings.add_work_error'));
    }
  }
  public function messages()
  {
      return [
          'title.required' => trans('strings.require_project_name'),
          'price.required'  => trans('strings.require_reference')
      ];
  }
  public function createWorkCategory($svid, $categories){
    if(sizeof($categories) > 0){
      foreach($categories as $catid){
          $scategory = new svcategories;
          $scategory->cvid = $svid;
          $scategory->catid = $catid;
          $scategory->save();
      }
    }
  }


}
