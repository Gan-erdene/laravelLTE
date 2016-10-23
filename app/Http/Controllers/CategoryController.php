<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index(){
        return view('category.add');
    }
    public function create(Request $request){
       $name = $request->input('name');
       $description = $request->input('description');
       $section_id = $request->input('section_id');
       $access = $request->input('access');
       $checkbox = $request->input('checkbox');
       $order_id = $request->input('order_id');

       if ($request->isMethod('post')) {
         $Category = new Category;

        $Category->name = $name;
        $Category->description = $description;
        $Category->section_id = $section_id;
        $Category->access = $access;
        $Category->checkbox = $checkbox;
        $Category->order_id = $order_id;

         $Category->save();
           }

    }
}
