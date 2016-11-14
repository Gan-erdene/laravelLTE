<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\sectiontype;
use App\Section;
use App\SectionTranslation;
use Validator;
use DB;

class SectionController extends Controller
{
    public function index(){
      $sections = sectiontype::all();
      $sectionList = Section::all();

      return view('section.sectionAdd')
        ->with('sectiontypes',$sections)
        ->with('sectionlist', $sectionList);
    }

    public function messages()
    {
        return [
            'secname.required' => 'Секци хоосон байж болохгүй!',
            'secdesc.required'  => 'Тайлбар хоосон байж болохгүй!',
            'secorder.required'  => 'Дараалал хоосон байж болохгүй!',
        ];
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'create': return $this->createSection($request);
        case 'edit': return $this->editSection($request);
        case 'delete': return $this->deleteSection($request);
        case 'list_li': return $this->selectUserSecions();
        case 'section' : return \Response::json(array('section'=>Section::find($request->id), 'translation'=>Section::find($request->id)->secTrans('mn')));
        default: break;
      }
    }

    public function selectUserSecions(){
      $sql = "select s.*, d.section_id, t.name as section_name from section s
          left join section_translation t on s.id = t.id and t.lang='mn'
          left join ( select distinct c.section_id from category c left join sf_guard_user_category w on c.id =w.catid where w.user_id = ".(\Auth::user()->id)." ) d on s.id = d.section_id
	       where s.published = 1 order by s.order_id desc";
      $list = DB::select($sql);
      $html = view('section.sectionItemLi',['sections'=>$list]);
      return response()->json(['html'=>$html->render()]);
    }

    public function deleteSection($request){
        $section = Section::find($request->input('deleteid'));
        $section->secTrans("mn")->delete();
        $section->delete();
        return back()
          ->with('status', 'success')
          ->with('message', 'Секцийг амжилттай устгалаа');
    }

    public function createSection($request){
      $validator = Validator::make($request->all(), [
          'secname' => 'required',
          'secdesc' => 'required',
          'secorder' => 'required',
      ], $this->messages());

      if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
      }

      $section = new Section;
      $section->published = $request->input('published') ? 1 : 0;
      $section->type_id = $request->input('sectype');
      $section->order_id = $request->input('secorder');
      $section->created_by = \Auth::user()->id;
      $section->save();

      $sectionTrans = new SectionTranslation;
      $sectionTrans->id = $section->id;
      $sectionTrans->name = $request->input('secname');
      $sectionTrans->description = $request->input('secdesc');
      $sectionTrans->lang = $request->input('seclang');
      $sectionTrans->save();
      return back()
        ->with('status', 'success')
        ->with('message', 'Секцийг амжилттай бүртгэлээ');
    }

    public function editSection($request){
        $validator = Validator::make($request->all(), [
            'secname' => 'required',
            'secdesc' => 'required',
            'secorder' => 'required',
        ], $this->messages());

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $section = Section::find($request->input('id'));
        $section->published = $request->input('published') ? 1 : 0;
        $section->type_id = $request->input('sectype');
        $section->order_id = $request->input('secorder');
        $section->updated_by = \Auth::user()->id;
        $section->update();

        $sectionTrans = $section->secTrans('mn');
        $sectionTrans->id = $section->id;
        $sectionTrans->name = $request->input('secname');
        $sectionTrans->description = $request->input('secdesc');
        $sectionTrans->lang = $request->input('seclang');
        $sectionTrans->update();
        return back()
          ->with('status', 'success')
          ->with('message', 'Хадгалагдлаа');
    }
}
