<?php

namespace App\Http\Controllers;

use App\SectionTranslation;
use App\Category;

use Illuminate\Http\Request;

use App\Http\Requests;

class contentController extends Controller
{
  public function index(){
    $section = SectionTranslation::where('lang','mn')->get();

    $category = Category::where('section_id',$section[0]->id)->get();
    return view('content.contentAdd')
    ->with('section',$section)
    ->with('category', $category);
  }

}
