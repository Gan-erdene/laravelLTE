<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\post;


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

        return view('home');
    }
    public function action(Request $request)
    {
        $post = new post;
        $post->body = $request->input('fulltext');
        $post->image = $request->input('upload');
        $post->user_id = \Auth::user()->id;
        $post->save();

        return back();
    }
}
