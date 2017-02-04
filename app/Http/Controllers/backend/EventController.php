<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Support\Str;
use Intervention\Image\Constraint;
use Intervention\Image\Facades\Image;
use App\Section;
use App\SfGuardUserCategory;
use DB;

class EventController extends Controller
{
    public function index(){
      $list = Event::orderBy('eventdate', 'desc')->get();
      return view('backend.event.list', ['list'=>$list]);
    }

    public function addView(){
      return view('backend.event.add');
    }

    public function events(Request $request){
      $userid = \Auth::user()->id;
      $m_s = $request->input('m_s'); // menu_section
      $m_c = $request->input('m_c'); // menu_category
      $saved = $request->input('s_d'); // saved_work
      $search = "";
      $events = Event::orderBy('eventdate', 'desc')->get();
      $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
      $userSections = $this->userSections();
      $userCategories = SfGuardUserCategory::where('user_id', $userid)->orderBy('catid', 'asc')->get();
      return view('frontend.event.list',[
        'userCategories'=>$userCategories,'sections'=>$sections,
        'm_s'=>$m_s, 'm_c'=>$m_c, 'saved'=>$saved,
        'userSections'=>$userSections, 'events'=>$events]);
    }

    public function viewEvent(Request $request, $id){
      $event = Event::find($id);
      $userid = \Auth::user()->id;
      $m_s = $request->input('m_s'); // menu_section
      $m_c = $request->input('m_c'); // menu_category
      $saved = $request->input('s_d'); // saved_work
      $search = "";
      $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
      $userSections = $this->userSections();
      $userCategories = SfGuardUserCategory::where('user_id', $userid)->orderBy('catid', 'asc')->get();
      return view('frontend.event.view',[
        'userCategories'=>$userCategories,'sections'=>$sections,
        'm_s'=>$m_s, 'm_c'=>$m_c, 'saved'=>$saved,
        'userSections'=>$userSections, 'event'=>$event]);
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'store': return $this->storeEvent($request);
        case 'delete': return $this->deleteEvent($request->input('value'));
        default:
          # code...
          break;
      }
    }

    public function deleteEvent($eventid){
      $event = Event::find($eventid);
      if($event->eventimage){
          unlink(public_path().$event->eventimage);
      }

      $event->delete();
      return response()->json(['id'=>"#row_".$eventid]);
    }

    public function storeEvent($request){
      $event = new Event();
      if($request->file('eventimage')){
        $event->eventimage = $this->uploadImage($request);
      }

      $event->title = $request->input('title');
      $event->content = $request->input('content');
      $event->eventdate = $request->input('eventdate');
      $event->created_userid = \Auth::user()->id;
      $event->save();
      return back()->with('status','success')->with('message',"Арга хэмжээ амжилттай бүртгэгдлээ");
    }

    public function uploadImage($request){
      $file = $request->file("eventimage");
      $filename = Str::random(20);

      $path = str_finish(DIRECTORY_SEPARATOR."uploads".DIRECTORY_SEPARATOR."events".DIRECTORY_SEPARATOR, '/');
      $fullPath = $path.$filename.'.'.$file->getClientOriginalExtension();

      if (!is_dir(public_path().$path)) {
          mkdir(public_path().$path, 0755, true);
      }
      $resize_width = 800;
      $resize_height = null;
      $image = Image::make($file)->resize($resize_width, $resize_height,
          function (Constraint $constraint) {
              $constraint->aspectRatio();
              $constraint->upsize();
          })->encode($file->getClientOriginalExtension(), 75);
      $image->save(public_path().$fullPath, 100);
      return $fullPath;
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
