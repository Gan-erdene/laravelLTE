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

    public function action(){
      switch (Input::get('action')) {
        case 'create': return $this->createSection();
        case 'edit': return $this->editSection();
        default: break;
      }
    }

    public function createSection(){
        echo Input::get('secname');
    }

    public function editSection(){

    }
}
