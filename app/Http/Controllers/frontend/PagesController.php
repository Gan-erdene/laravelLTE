<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PageHelp;

class PagesController extends Controller
{
    public function help(){
      $helps = PageHelp::where('is_active',1)->orderBy('order_id', 'asc')->get();
      return view('frontend.pages.help', ['helps'=>$helps, '_page'=>'help']);
    }

    public function about(){
      return view('frontend.pages.about', ['_page'=>'about']);
    }

    public function member(){
      return view('frontend.pages.member', ['_page'=>'member']);
    }
}
