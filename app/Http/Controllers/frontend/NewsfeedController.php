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
use App\sf_guard_user;
use App\Models\Groups;
use App\Models\Poll;
class NewsfeedController extends Controller
{
    public function index(Request $request){
      $userid = \Auth::user()->id;
      $m_s = $request->input('m_s'); // menu_section
      $m_c = $request->input('m_c'); // menu_category
      $saved = $request->input('s_d'); // saved_work
      $search = $request->input('search');

      if($search){
        $search = str_replace("/", "%2F", $search);
      }

      $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
      $userSections = $this->userSections();
      $userCategories = SfGuardUserCategory::where('user_id', $userid)->orderBy('catid', 'asc')->get();
      $finduser = new FindUserController();
      $users = $finduser->getUnfriendList(0, 4);
      $ungroups = $this->unGroups($userid);
      return view('frontend.newsfeed.index',[
        'userCategories'=>$userCategories,'sections'=>$sections,
        'm_s'=>$m_s, 'm_c'=>$m_c, 'saved'=>$saved, 'right_users'=>$users, 'ungroups'=>$ungroups,'search'=>$search,
        'userSections'=>$userSections]);
    }

    public function unGroups($userid){
      $sql = "select * from groups s where s.id not in (select distinct group_id from group_users u where u.user_id = $userid) order by s.updated_at";
      $list = DB::select($sql);
      return $list;
    }

    public function showWork($workid){
      $work = Works::find($workid);
      if($work->is_active == 0){
        return redirect('/frontend/newsfeed')->with('status', 'danger')->with('message', 'Ажил устгагдсан байна');
      }
      $userInfo = sf_guard_user::find($work->userid);
      $categories = WorkCategories::where('workid', $workid)->get();
      return view('frontend.newsfeed.viewWork', [
        'work'=>$work, 'categories'=>$categories, 'userinfo'=>array('created_at'=>$userInfo->created_at)
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
        case 'post_my': return response()->json(['html'=>$this->postMy()]);
        case 'post_saved': return response()->json(['html'=>$this->savedPostWorks()]);
        case 'post_category': return response()->json(['html'=>$this->postByCategory($request)]);
        case 'post_section': return response()->json(['html'=>$this->postBySection($request)]);
        case 'user_rate' :return response()->json(['rate'=>$this->userRate()]);
        case 'post_search': return response()->json(['html'=>$this->postSearch($request)]);
        default: break;
      }
    }

    public function postSearch($request){
      $posts = Works::where('project_name', 'like', '%'.$request->input('value').'%')
         ->orWhere('reference', 'like', '%' . $request->input('value') . '%')
         ->orWhere('skill', 'like', '%' . $request->input('value') . '%')->get();
      $html = view('frontend.newsfeed.search', ['posts'=>$posts]);
      return $html->render();
    }

    public function userRate(){
      $userid = \Auth::user()->id;
      $poll = Poll::where('user_id', $userid);
      $star = 0;
      $count = 0;
      if($poll->first()){
        $count = $poll->count();
        $rate = $poll->sum('rate');
        $star = intval($rate/$count);
      }
      $html = "";
      for($i=1; $i<=5; $i++){
        if($i<=$star){
            $html .="<i  class='fa fa-star'></i>";
        }else{
            $html .="<i style='color:#999' class='fa fa-star'></i>";
        }
      }


      return $html."<span> &nbsp; &nbsp; &nbsp; ".number_format($count)." &nbsp;</span><i class='fa fa-user'></i>";
    }

    public function postByCategory($request){
      $value = $request->input('value');
      $sql="select u.last_name, u.profile_image, u.first_name, l.likecount, w.* from works w
          	left join sf_guard_user u  on w.userid = u.id
            left join (select count(post_id) likecount, post_id from likes group by post_id ) l on w.id = l.post_id
              where w.is_active = 1 and w.id in (SELECT distinct u.workid FROM work_categories u where u.catid =  $value) order by w.updated_at desc";
      $works = DB::select($sql);
      $html = view('frontend.newsfeed.postWork', ['works'=>$works]);
      return $html->render();
    }

    public function postBySection($request){
      $value = $request->input('value');
      $sql="select u.last_name, u.profile_image, u.first_name, l.likecount, w.* from works w
          	left join sf_guard_user u  on w.userid = u.id
            left join (select count(post_id) likecount, post_id from likes group by post_id ) l on w.id = l.post_id
              where w.is_active = 1 and w.id in (SELECT distinct u.workid FROM work_categories u where u.section_id =  $value) order by w.updated_at desc";
      $works = DB::select($sql);
      $html = view('frontend.newsfeed.postWork', ['works'=>$works]);
      return $html->render();
    }

    public function savedPostWorks(){
      $sql="select u.last_name, u.profile_image,l.likecount, u.first_name, w.* from works w
		left join work_user_saved s on w.id = s.workid and s.is_saved = 1
          	left join sf_guard_user u  on w.userid = u.id
            left join (select count(post_id) likecount, post_id from likes group by post_id ) l on w.id = l.post_id
              where w.is_active = 1 and s.id is not null  order by w.updated_at desc";
      $works = DB::select($sql);
      $html = view('frontend.newsfeed.postWork', ['works'=>$works]);
      return $html->render();
    }

    public function postWorks(){
      $sql="select u.last_name, u.profile_image,l.likecount, u.first_name, w.* from works w
          	left join sf_guard_user u  on w.userid = u.id
            left join (select count(post_id) likecount, post_id from likes group by post_id ) l on w.id = l.post_id
              where w.is_active = 1 and (w.id in (SELECT distinct c.workid FROM sf_guard_user_category u left join work_categories c on u.catid = c.catid WHERE u.user_id = ".\Auth::user()->id.") or w.type <> 1)  order by w.updated_at desc";
      $works = DB::select($sql);
      $html = view('frontend.newsfeed.postWork', ['works'=>$works]);
      return $html->render();
    }

    public function postMy(){
      $userid = \Auth::user()->id;
      $sql="select u.last_name, u.profile_image,l.likecount, u.first_name, w.* from works w
          	left join sf_guard_user u  on w.userid = u.id
            left join (select count(post_id) likecount, post_id from likes group by post_id ) l on w.id = l.post_id
              where w.is_active = 1 and w.userid = $userid order by w.updated_at desc";
      $works = DB::select($sql);
      $html = view('frontend.newsfeed.postWork', ['works'=>$works]);
      return $html->render();
    }

}
