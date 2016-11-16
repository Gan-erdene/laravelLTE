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

class HomeController extends Controller
{
  public function home(Request $request)
  {
    $user = sf_guard_user::find(\Auth::user()->id);
    $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
    $sv_lists = sv::where('user_id',\Auth::user()->id)->orderBy('created_at','desc')->get();
    return view('frontend.home')
    ->with('user',$user)
    ->with('sections',$sections)
    ->with('sv_lists',$sv_lists);
  }

  public function post(Request $request)
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
    $sv = new sv;
    $sv->title = $title;
    $sv->body = $body;
    if($price)
    $sv->price = $price;

    if(isset($request->imagename)){
        $imagename = time().'.'.$request->imagename->getClientOriginalName();
    $request->imagename->move(public_path('uploads/svfile'), $imagename);

   $sv->filename = $imagename;
    }
    $sv->is_active = 1;
    $sv->user_id = \Auth::user()->id;
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
