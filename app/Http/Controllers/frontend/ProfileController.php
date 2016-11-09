<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(Request $request){
      return view('frontend.edit_profile');
    }
    public function action(Request $request){
      return view('frontend.edit_profile');
    }
}
