<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\post;
use App\sf_guard_user;
use App\Category;
use App\Section;
use App\Models\WorkTxn;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $ordercount = WorkTxn::count();
      $sectioncount = Section::count();
      $categorycount = Category::count();
      $usercount =sf_guard_user::count();
        return view('home', ['usercount'=>$usercount, 'categorycount'=>$categorycount, 'sectioncount'=>$sectioncount, 'ordercount'=>$ordercount]);
    }

}
