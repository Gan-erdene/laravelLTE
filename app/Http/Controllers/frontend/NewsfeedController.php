<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Section;
class NewsfeedController extends Controller
{
    public function index(){
      $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
      return view('frontend.newsfeed.index',['sections'=>$sections]);
    }
}
