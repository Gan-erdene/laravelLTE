<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Section;
use App\Category;
use App\Works;
use App\WorkCategories;

class WorkController extends Controller
{
    public function addWork(){
      $sections = Section::orderBy('order_id', 'asc')->get();
      return view('frontend.workAdd')
          ->with('sections', $sections);
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'category': return $this->getCategoryBySetion($request);
        case 'creatework' : return $this->createWork($request);
        default: break;
      }
    }

    public function getCategoryBySetion($request){
      $categories = Category::where('section_id', $request->input('section_id'))->orderBy('order_id', 'asc')->get();
      $view = view('category.checkbox_cat',['categories'=>$categories]);
      return response()->json(['html'=>$view->render()]);
    }

    public function createWork($request){
      $project_name = $request->input('project_name');
      $reference = $request->input('reference');
      $skill = $request->input('your_skill');
      $price = $request->input('price');
      $duration_type = $request->input('duration_type');
      $duration = $request->input('duration');

      $work = new Works;
      $work->project_name = $project_name;
      $work->reference = $reference;
      $work->skill = $skill;
      $work->price = $price;
      $work->duration = $duration;
      $work->duration_type = $duration_type;
      $work->userid = \Auth::user()->id;
      $status = $work->save();
      if($status){
          $this->createWorkCategory($work->id, $request->input('categories'));
          return back()->with('status', 'success')->with('message', trans('strings.add_work_success'));
      }else{
          return back()->with('status', 'error')->with('message', trans('strings.add_work_error'));
      }
    }

    public function createWorkCategory($workid, $categories){
      foreach($categories as $catid){
          $wcateogry = new WorkCategories;
          $wcateogry->workid = $workid;
          $wcateogry->catid = $catid;
          $wcateogry->save();
      }
    }

    public function listWork(){
      return view('frontend.workList');
    }
}
