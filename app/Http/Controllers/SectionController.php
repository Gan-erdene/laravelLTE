<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\sectiontype;
use App\Section;
use App\SectionTranslation;
class SectionController extends Controller
{
    public function index(){
      $sections = sectiontype::all();
      return view('section.add')
        ->with('sectiontypes',$sections);
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'create': return $this->createSection($request);
        case 'edit': return $this->editSection();
        default: break;
      }
    }

    public function createSection($request){
      $section = new Section;
      $section->published = 1;
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
        ->with('message', 'Хадгалагдлаа');

    }

    public function editSection(){

    }
}
