<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
use App\Friends;
use App\FriendUpdates;
use Illuminate\Http\Response;

class FindUserController extends Controller
{
    public function index(){
      $users = $this->getUnfriendList();
      return view('frontend.find_user')
        ->with('users', $users);
    }

    public function getUnfriendList(){
      $sql = "SELECT S.id, S.last_name, S.first_name, S.email_address, F.STATUS user_status, V.STATUS friend_status FROM sf_guard_user S
	               LEFT JOIN friends F ON S.id = F.user_id and F.status <> 1 and F.friend_user_id = ".\Auth::user()->id."
                 LEFT JOIN friends V ON S.id = V.friend_user_id and V.status <> 1 and V.user_id = ".\Auth::user()->id." WHERE
              S.ID <> ".\Auth::user()->id;
      $list = DB::select($sql);
      return $list;
    }

    public function action(Request $request){
      switch ($request->input('action')) {
        case 'friend_request': return $this->friendRequest($request);
        case 'accept': return $this->acceptRequest($request);
        case 'cancel': return $this->cancelRequest($request);
        default:break;
      }
    }

    public function cancelRequest($request){
        $userid = $request->input('userid');
        $user = Friends::where('user_id','=',\Auth::user()->id, 'and', 'friend_user_id','=',$userid)->first();
        if(!$user){
          return response()->json([
              'status'=>false, 'message'=>'Энэ хэрэглэгчтэй та найз болоогүй байна.'
          ]);
        }
        FriendUpdates::where('friend_id', $user->id)->delete();
        $status = $user->delete();
        return response()->json(['userid'=>$request->input('userid'),
            'status'=>$status
        ]);
    }

    public function acceptRequest($request){
        $userid = $request->input('userid');
        $user = Friends::where('friend_user_id','=',\Auth::user()->id, 'and', 'user_id','=',$userid)->first();
        //naiz bolow
        $user->status = 1;
        $status = $user->save();
        return response()->json(['userid'=>$request->input('userid'),
            'status'=>$status
        ]);
    }

    public function friendRequest($request){
        if($this->canRequest(\Auth::user()->id, $request->input('userid')) > 0){
          return response()->json([
              'status'=>false, 'message'=>'Хүсэлт явуулах боломжгүй байна'
          ]);
        }

        $friend = new Friends();
        $friend->user_id = \Auth::user()->id;
        $friend->friend_user_id = $request->input('userid');
        $friend->created_at = new \DateTime();
        //naiziin huselt ywuulsan
        $friend->status = 0;
        $status = $friend->save();
        if($status){
          $fupdate = new FriendUpdates();
          $fupdate->friend_id = $friend->id;
          $fupdate->created_at = new \DateTime();
          $fupdate->status = $friend->status;
          $fupdate->user_id = \Auth::user()->id;
          $fupdate->save();
        }
        return response()->json(['userid'=>$request->input('userid'),
            'status'=>$status
        ]);
    }

    public function canRequest($userid, $friendid){
      $sql = "select count(*) too from friends s
	       where (s.friend_user_id = $userid and user_id = $friendid) or (s.friend_user_id = $friendid and user_id = $userid)";
      $count = DB::select($sql);
      return $count[0]->too;
    }
}
