<?php

namespace App\Http\Controllers;

use App\SectionTranslation;
use App\CategoryTranslation;

use Illuminate\Http\Request;

use App\Http\Requests;

class contentController extends Controller
{
  public function index(){
    $section = SectionTranslation::where('lang','mn')->get();
    $category = CategoryTranslation::where('lang','mn')->get();
    return view('content.contentAdd')
    ->with('section',$section)
    ->with('category', $category);
  }

}
