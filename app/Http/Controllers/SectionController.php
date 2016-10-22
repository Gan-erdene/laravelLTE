<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SectionController extends Controller
{
    public function index(){
      return view('section.add');
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
