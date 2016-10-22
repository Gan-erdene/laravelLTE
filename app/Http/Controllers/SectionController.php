<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\sectiontype;
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
      $section = new sectiontype;

        $flight->name = $request->name;

        $flight->save();
        echo $request->input('secname');
    }

    public function editSection(){

    }
}
