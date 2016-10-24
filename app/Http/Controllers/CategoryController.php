<?php

namespace App\Http\Controllers;
use App\SectionTranslation;
use App\Category;
use App\CategoryTranslation;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index(){
        $section = SectionTranslation::where('lang','mn')->get();
        $category = Category::all();
        return view('category.categoryAdd')
        ->with('category',$category)
        ->with('section',$section);

    }
    public function create(Request $request){



        $category = new Category;

        $category->section_id = $request->input('section_id');
        $category->published = '1';
        $category->order_id = $request->input('order_id');
        $category->created_by = \Auth::user()->id;
        $category->save();

         $sectionTranslation = new CategoryTranslation;
         $sectionTranslation->id = $category->id;
         $sectionTranslation->name = $request->input('name');
         $sectionTranslation->description = $request->input('description');
         $sectionTranslation->lang = $request->input('catlang');
         $sectionTranslation->save();



         return back()
           ->with('status', 'success')
           ->with('message', 'Хадгалагдлаа');

    }
}
