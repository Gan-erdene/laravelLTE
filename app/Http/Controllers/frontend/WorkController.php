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
use App\WorkUserProposal;
use App\WorkUserSaved;

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
        case 'proposal': return $this->createProposal($request);
        case 'save_proposal': return $this->saveProposal($request);
        case 'proposals':return $this->proposals($request);
        case 'my_prop':return $this->myProposal($request);
        case 'confirm_proposal': return $this->confirmProposal($request);
        case 'reject_proposal': return $this->rejectProposal($request);
        default: break;
      }
    }

    public function myProposal($request){
      $workid = $request->input('workid');
      $proposal = WorkUserProposal::where('workid', $workid)->where('user_id', \Auth::user()->id)->get();
      $html = view('frontend.work.my_proposal', ['proposals'=>$proposal]);
      return response()->json(['html'=>$html->render()]);
    }

    public function confirmProposal($request){
      $pid = $request->input('confirm_proposalid');
      $proposal = WorkUserProposal::find($pid);
      $proposal->status = 1; //sanaliig zuwshuursun
      $status = $proposal->save();
      return redirect()->route('newsfeedWork',$proposal->workid);
    }

    public function rejectProposal($request){
      $pid = $request->input('reject_proposalid');
      $proposal = WorkUserProposal::find($pid);
      $proposal->status = 2; //sanaliig tatgalzsan
      $status = $proposal->save();
      return redirect()->route('newsfeedWork',$proposal->workid);
    }

    public function proposals($request){
      $workid = $request->input('workid');
      $proposals = WorkUserProposal::where('workid', $workid)->get();
      $html = view('frontend.work.proposal', ['proposals'=>$proposals]);
      return response()->json(['html'=>$html->render()]);
    }

    public function saveProposal($request){
      $user_id = \Auth::user()->id;
      $workid = $request->input('workid');
      $check = WorkUserSaved::where('user_id', $user_id)->where('workid', $workid)->first();
      $status = false;
      if($check){
        $check->is_saved = $check->is_saved === 0 ? 1 : 0;
        $status = $check->update();
        $btntext = $check->is_saved === 0 ? "<i class='fa fa-circle-o'></i> Ажлыг хадгалах" : "<i class='fa fa-circle'></i> Хадгалсан";
        return response()->json(['status'=>$status,'message'=>trans('strings.unsaved'), 'btntext'=>$btntext]);
      }else{
        $worksave = new WorkUserSaved;
        $worksave->workid = $workid;
        $worksave->user_id = $user_id;
        $worksave->is_saved = 1;
        $status = $worksave->save();
        return response()->json(['status'=>$status,'message'=>trans('strings.unsaved'), 'btntext'=>"<i class='fa fa-circle'></i> Хадгалсан"]);
      }
    }

    public function createProposal($request){
      $workid = $request->input('workid');
      $user_id = \Auth::user()->id;
      $proposal = $request->input('proposal');
      $check = WorkUserProposal::where('user_id', $user_id)->where('workid', $workid)->count();
      if($check>0){
        return redirect()->route('newsfeedWork',$workid)->with('status','warning')->with('message', 'Та санал өгсөн тул дахин санал өгөх боломжгүй');
      }
      $wuproposal = new WorkUserProposal;
      $wuproposal->workid = $workid;
      $wuproposal->user_id = $user_id;
      $wuproposal->proposal = $proposal;
      $status = $wuproposal->save();
      if($status){
        return redirect()->route('newsfeedWork',$workid)->with('status','success')->with('message', 'Таны саналыг хүлээн авлаа');
      }else{
        return redirect()->route('newsfeedWork',$workid)->with('status','danger')->with('message', 'Санал илгээх үед алдаа гарлаа');
      }

    }

    public function saveWork($request){
      $validator = Validator::make($request->all(), [
          'project_name' => 'required',
          'reference' => 'required',
          'startdate' => 'required',
          'enddate' => 'required'
      ], $this->messages());

      if ($validator->fails()) {
          return back()
                      ->withErrors($validator, 'add');
      }

      $project_name = $request->input('project_name');
      $reference =  $request->input('reference');
      $skill = $request->input('your_skill');
      $price = $request->input('price');
      $enddate = $request->input('enddate');
      $startdate = $request->input('startdate');
      $is_active = $request->input('is_active') ? $request->input('is_active') : 0;

      $work = Works::find($request->input('workid'));
      $work->project_name = $project_name;
      $work->reference = $reference;

      $work->skill = ($skill) ? $skill : null;
      $work->price = ($price) ? $price : null;
      $work->is_active = $is_active;
      $work->startdate = $startdate;
      $work->enddate = $enddate;
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
            'reference.required'  => trans('strings.require_reference'),
            'startdate.required'  => trans('strings.require_startdate'),
            'enddate.required'  => trans('strings.require_enddate')
        ];
    }

    public function createWork($request){

      $validator = Validator::make($request->all(), [
          'project_name' => 'required',
          'reference' => 'required',
          'startdate' => 'required',
          'enddate' => 'required'
      ], $this->messages());

      if ($validator->fails()) {
          return back()
                      ->withErrors($validator, 'add');
      }

      $project_name = $request->input('project_name');
      $reference = $request->input('reference');
      $skill = $request->input('your_skill');
      $price = $request->input('price');
      $startdate = $request->input('startdate');
      $enddate = $request->input('enddate');
      $is_active = $request->input('is_active') ? $request->input('is_active') : 0;

      $work = new Works;
      $work->project_name = $project_name;
      $work->reference = $reference;
      if($skill)
        $work->skill = $skill;
      if($price)
        $work->price = $price;
      $work->is_active = $is_active;
      $work->startdate = $startdate;
      $work->enddate = $enddate;
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
