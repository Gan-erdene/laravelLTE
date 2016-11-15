<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Section;
use DB;
use App\SfGuardUserCategory;
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

    public function userSections(){
      $user_id = \Auth::user()->id;
      $sql = "select s.*, t.name section_name from section s
        left join section_translation t on s.id = t.id and t.lang = 'mn'
        where s.id in (select distinct section_id from sf_guard_user_category y where y.user_id = $user_id ) order by s.order_id";
      $list = DB::select($sql);
      return $list;
    }


}
