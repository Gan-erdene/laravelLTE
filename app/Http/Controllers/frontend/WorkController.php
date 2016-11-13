<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Section;
use App\Category;
use App\Works;
use App\WorkCategories;
use Validator;
use DB;
use App\WorkFiles;

class WorkController extends Controller
{
    public function addWork(){
      $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
      return view('frontend.workAdd')
          ->with('sections', $sections);
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

    public function saveWork($request){
      $validator = Validator::make($request->all(), [
          'project_name' => 'required',
          'reference' => 'required'
      ], $this->messages());

      if ($validator->fails()) {
          return back()
                      ->withErrors($validator, 'add');
      }

      $project_name = $request->input('project_name');
      $reference =  $request->input('reference');
      $skill = $request->input('your_skill');
      $price = $request->input('price');
      $duration_type = $request->input('duration_type');
      $duration = $request->input('duration');
      $is_active = $request->input('is_active') ? $request->input('is_active') : 0;

      $work = Works::find($request->input('workid'));
      $work->project_name = $project_name;
      $work->reference = $reference;

      $work->skill = ($skill) ? $skill : null;
      $work->price = ($price) ? $price : null;
      $work->is_active = $is_active;
      $work->duration = ($duration) ? $duration : null;
      $work->duration_type = ($duration_type) ? $duration_type : null;
      $work->userid = \Auth::user()->id;
      $status = $work->save();
      if($status){
          WorkCategories::where('workid', $work->id)->delete();
          $this->createWorkCategory($work->id, $request->input('categories'));
          return back()->with('status', 'success')->with('message', trans('strings.saved'));
      }else{
          return back()->with('status', 'error')->with('message', trans('strings.unsaved'));
      }
    }

    public function deleteWork($workid){
      $work = Works::find($workid);
      if(!$work){
        WorkCategories::where('workid', $workid)->delete();
        WorkFiles::where('workid', $workid)->delete();
        return back()
          ->with('status', 'warnings')
          ->with('message', trans('strings.was_deleted'));
      }
      $status_work = $work->delete();
      if($status_work){
        WorkCategories::where('workid', $workid)->delete();
        WorkFiles::where('workid', $workid)->delete();
        return back()
          ->with('status', 'success')
          ->with('message', trans('strings.deleted'));
      }else{
        return back()
          ->with('status', 'error')
          ->with('message', trans('strings.undeleted'));
      }
    }

    public function getCategoryBySetion($request){
      $categories = Category::where('section_id', $request->input('section_id'))->orderBy('order_id', 'asc')->get();
      $view = view('category.checkbox_cat',['categories'=>$categories]);
      return response()->json(['html'=>$view->render()]);
    }

    public function messages()
    {
        return [
            'project_name.required' => trans('strings.require_project_name'),
            'reference.required'  => trans('strings.require_reference')
        ];
    }

    public function createWork($request){

      $validator = Validator::make($request->all(), [
          'project_name' => 'required',
          'reference' => 'required'
      ], $this->messages());

      if ($validator->fails()) {
          return back()
                      ->withErrors($validator, 'add');
      }

      $project_name = $request->input('project_name');
      $reference = $request->input('reference');
      $skill = $request->input('your_skill');
      $price = $request->input('price');
      $duration_type = $request->input('duration_type');
      $duration = $request->input('duration');
      $is_active = $request->input('is_active') ? $request->input('is_active') : 0;

      $work = new Works;
      $work->project_name = $project_name;
      $work->reference = $reference;
      if($skill)
        $work->skill = $skill;
      if($price)
        $work->price = $price;
      $work->is_active = $is_active;
      if($duration)
        $work->duration = $duration;
      if($duration_type)
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
      if(sizeof($categories) > 0){
        foreach($categories as $catid){
            $wcateogry = new WorkCategories;
            $wcateogry->workid = $workid;
            $wcateogry->catid = $catid;
            $wcateogry->save();
        }
      }
    }

    public function listWork(){
      $list = Works::where('userid', \Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);
      return view('frontend.workList', ['list'=>$list]);
    }

    public function editWork($workid){
      $work = Works::find($workid);
      if(!$work){
        return redirect()->route('listWork')->with('status', 'warning')->with('message', sprintf(trans('strings.invalid_workid'), $workid));
      }
      $sections = $this->getcheckedSection($workid);
      $categories = $this->getCategoryByWork($workid);
      return view('frontend.workEdit', ['sections'=>$sections, 'work'=>$work, 'categories'=>$categories]);
    }

    public function getcheckedSection($workid){
      $sql = "select s.*, d.section_id, t.name as section_name from section s
          left join section_translation t on s.id = t.id and t.lang='mn'
          left join ( select distinct c.section_id from category c left join work_categories w on c.id =w.catid where w.workid = $workid ) d on s.id = d.section_id
	       where s.published = 1 order by s.order_id desc";
      $list = DB::select($sql);
      return $list;
    }

    public function getCategoryByWork($workid){
      $sql="select c.*, t.name catname, w.catid from category c
          	left join category_translation t on c.id = t.id and t.lang = 'mn'
          	left join work_categories w on c.id = w.catid and w.workid = $workid
              where c.published = 1 and c.section_id in (select distinct c.section_id from category c left join work_categories w on c.id =w.catid where w.workid = $workid )
              order by c.section_id asc, c.order_id asc";
      $list = DB::select($sql);
      return $list;
    }
}