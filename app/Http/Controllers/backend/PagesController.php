<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PageHelp;
use Validator;

class PagesController extends Controller
{
    public function help(){
      return view('backend.pages.create_help');
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'add_help': return $this->addHelp($request);
        case 'edit_help': return $this->saveHelp($request);
        default:
          # code...
          break;
      }
    }

    public function saveHelp($request){
      $validator = Validator::make($request->all(), [
          'order_id' => 'required',
          'questions' => 'required',
          'answers' => 'required',
      ], $this->messages());

      if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
      }
      $pagehelp = PageHelp::find($request->input('helpid'));
      $pagehelp->questions = $request->input('questions');
      $pagehelp->answers = $request->input('answers');
      $pagehelp->order_id = $request->input('order_id');
      $pagehelp->updated_by = \Auth::user()->id;
      $pagehelp->update();

      return back()
        ->with('status', 'success')
        ->with('message', 'Тусламж амжилттай хадгалагдлаа');
    }

    public function addHelp($request){
      $validator = Validator::make($request->all(), [
          'order_id' => 'required',
          'questions' => 'required',
          'answers' => 'required',
      ], $this->messages());

      if ($validator->fails()) {
          return back()
                      ->withErrors($validator)
                      ->withInput();
      }
      $pagehelp = new PageHelp();
      $pagehelp->questions = $request->input('questions');
      $pagehelp->answers = $request->input('answers');
      $pagehelp->order_id = $request->input('order_id');
      $pagehelp->is_active = 1;
      $pagehelp->created_by = \Auth::user()->id;
      $pagehelp->save();

      return back()
        ->with('status', 'success')
        ->with('message', 'Тусламж амжилттай бүртгэлээ');
    }

    public function messages()
    {
        return [
            'questions.required' => 'Асуулт хоосон байж болохгүй!',
            'answers.required'  => 'Хариулт хоосон байж болохгүй!',
            'order_id.required'  => 'Дараалал хоосон байж болохгүй!',
        ];
    }

    public function helpList(){
      $helps = PageHelp::where('is_active',1)->orderBy('order_id', 'asc')->paginate(10);
      return view('backend.pages.list_help', ['helps'=>$helps]);
    }

    public function editHelp($helpid){
      $help = PageHelp::find($helpid);
      return view('backend.pages.edit_help', ['help'=>$help]);
    }
}
