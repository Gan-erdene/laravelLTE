<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use App\Category;
use App\Works;
use App\WorkCategories;
use Validator;
use DB;
use App\WorkFiles;
use App\WorkUserProposal;
use App\WorkUserSaved;
use App\Models\Comment_post;
use App\Comment;

class CommentController extends Controller
{
  public function action(Request $request){
    switch ($request->input('action')) {
      case 'add': return $this->addComment($request);
      case 'add_post': return $this->addPostComment($request);

      default: break;
    }
  }

  public function getComments($prop_id){
    $comments = Comment::where('prop_id', $prop_id)->orderBy('created_at','asc')->get();
    return $comments;
  }

  public function getPostComments($workid){
    $comments = Comment_post::where('workid', $workid)->orderBy('created_at','asc')->get();
    return $comments;
  }

  public function addPostComment($request){
    $workid = $request->input('workid');
    $comment_text = $request->input('comment');
    $comment = new Comment_post;
    $comment->workid = $workid;
    $comment->comment_text = $comment_text;
    $comment->user_id = \Auth::user()->id;
    $comment->ipaddress = $_SERVER["REMOTE_ADDR"];
    $comment->save();
    $comments = view('frontend.work.comments', ['comments'=>$this->getPostComments($workid)]);
    return response()->json(['comments'=>$comments->render(), 'workid'=>$workid]);
  }

  public function addComment($request){
    $proposalid = $request->input('propid');
    $comment_text = $request->input('comment');
    $comment = new Comment;
    $comment->prop_id = $proposalid;
    $comment->comment_text = $comment_text;
    $comment->user_id = \Auth::user()->id;
    $comment->ipaddress = $_SERVER["REMOTE_ADDR"];
    $comment->save();
    $comments = view('frontend.work.comments', ['comments'=>$this->getComments($proposalid)]);
    return response()->json(['comments'=>$comments->render(), 'propid'=>$proposalid]);
  }
}
