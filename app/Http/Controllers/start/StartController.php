<?php

namespace App\Http\Controllers\start;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use App\Category;
use App\Works;
use App\WorkCategories;

class StartController extends Controller
{
    public function index(){
      $section = Section::where('published', 1)->orderBy('order_id', 'asc')->get();
      return view('start.home', ['sections'=> $section]);
    }

    public function startCatView(Request $request){
      $category = Category::find($request->input('id'));
      $categories = Category::where('section_id', $category->section_id)->get();
      $section = Section::find($category->section_id);
      $works = WorkCategories::where('catid', $request->input('id'))->get();
      return view('start.catview', ['category'=>$category, 'works'=>$works, 'section'=>$section, 'categories'=>$categories]);
    }
}
