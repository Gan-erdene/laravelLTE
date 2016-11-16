<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Section;
use DB;
use App\SfGuardUserCategory;
use App\Works;
use App\WorkCategories;
use App\WorkUserProposal;
class NewsfeedController extends Controller
{
    public function index(Request $request){
      $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
      $userSections = $this->userSections();
      $m_s = $request->input('m_s'); // menu_section
      $m_c = $request->input('m_c'); // menu_category
      $userCategories = SfGuardUserCategory::where('user_id', \Auth::user()->id)->orderBy('catid', 'asc')->get();
      return view('frontend.newsfeed.index',[
        'userCategories'=>$userCategories,
        'm_s'=>$m_s, 'm_c'=>$m_c,
        'userSections'=>$userSections]);
    }

    public function showWork($workid){
      $work = Works::find($workid);
      if($work->is_active == 0){
        return redirect('/frontend/newsfeed')->with('status', 'danger')->with('message', 'Ажил устгагдсан байна');
      }
      $categories = WorkCategories::where('workid', $workid)->get();
      $proposal = WorkUserProposal::where('workid', $workid)->where('user_id', \Auth::user()->id)->first();

      $proposals = array();
      if($work->userid === \Auth::user()->id){
          $proposals = WorkUserProposal::where('workid', $workid)->get();
      }
      return view('frontend.newsfeed.viewWork', [
        'work'=>$work, 'categories'=>$categories, 'proposal'=>$proposal, 'proposals'=>$proposals
      ]);
    }

    public function userSections(){
      $user_id = \Auth::user()->id;
      $sql = "select s.*, t.name section_name from section s
        left join section_translation t on s.id = t.id and t.lang = 'mn'
        where s.id in (select distinct section_id from sf_guard_user_category y where y.user_id = $user_id ) order by s.order_id";
      $list = DB::select($sql);
      return $list;
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'post_work': return response()->json(['html'=>$this->postWorks()]);

        default: break;
      }
    }

    public function postWorks(){
      $sql="select u.last_name, u.profile_image, u.first_name, w.* from works w
          	left join sf_guard_user u  on w.userid = u.id
              where w.is_active = 1";
      $works = DB::select($sql);
      $html = view('frontend.newsfeed.postWork', ['works'=>$works]);
      return $html->render();
    }

}
