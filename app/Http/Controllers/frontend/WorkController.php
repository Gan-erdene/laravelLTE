<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Section;
use App\Category;

class WorkController extends Controller
{
    public function addWork(){
      $sections = Section::orderBy('order_id', 'asc')->get();
      return view('frontend.workAdd')
          ->with('sections', $sections);
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'category': return $this->getCategoryBySetion($request);
        default: break;
      }
    }

    public function getCategoryBySetion($request){
      $categories = Category::where('section_id', $request->input('section_id'))->orderBy('order_id', 'asc')->get();
      $view = view('category.checkbox_cat',['categories'=>$categories]);
      return response()->json(['html'=>$view->render()]);
    }
}
