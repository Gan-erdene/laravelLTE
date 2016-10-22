<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SectionController extends Controller
{
    public function index(){
      return view('section.add');
    }
}
