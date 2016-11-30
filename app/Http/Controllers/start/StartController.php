<?php

namespace App\Http\Controllers\start;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;

class StartController extends Controller
{
    public function index(){
      $section = Section::where('published', 1)->orderBy('order_id', 'asc')->get();
      return view('start.home', ['sections'=> $section]);
    }
}
