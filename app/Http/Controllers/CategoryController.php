<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CategoryController extends Controller
{
    public function index(){
        return view('category.add');
    }
    public function create(Request $request, $id){
       $name = $request->input('name');
       $description = $request->input('description');
       $description = $request->input('description');
    }
}
