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
	               LEFT JOIN friends F ON S.id = F.user_id and F.friend_user_id = ".\Auth::user()->id."
                 LEFT JOIN friends V ON S.id = V.friend_user_id and V.user_id = ".\Auth::user()->id." WHERE
              S.ID <> ".\Auth::user()->id." and 1=case when V.status =  1 or F.status = 1 then 0 else 1 end";
      $list = DB::select($sql);
      return $list;
    }

    public function action(Request $request){
      $string = $request->input('action');
      $action = explode('_', $string);
      switch ($action[0]) {
        case 'add': return $this->friendRequest($action[1]);
        case 'acc': return $this->acceptRequest($action[1]);
        case 'can': return $this->cancelRequest($action[1]);
        case 'dec': return $this->declineRequst($action[1]);
        case 'friend_list' : return friendList();
        default:break;
      }
    }

    public function declineRequst($userid){
      $checkeduser = $this->canCancel($userid, \Auth::user()->id);
      if(!$checkeduser){
        return response()->json([
            'status'=>false, 'message'=>'Хэрэглэгч найзын хүсэлтээ буцаасан байна.'
        ]);
      }
      $user = Friends::find($checkeduser[0]->id);
      $user->status = 2;
      $status = $user->save();

      if($status){
        $fupdate = new FriendUpdates();
        $fupdate->friend_id = $user->id;
        $fupdate->created_at = new \DateTime();
        $fupdate->status = $user->status;
        $fupdate->user_id = \Auth::user()->id;
        $fupdate->save();
      }

      return response()->json(['dataid'=>$userid,
          'status'=>$status, 'btntext'=>trans('strings.declined')
      ]);
    }

    public function friendList(){

    }

    public function canCancel($userid, $friendid){
      $sql = "select s.* from friends s
	       where (s.friend_user_id = $userid and user_id = $friendid) or (s.friend_user_id = $friendid and user_id = $userid)";
      $user = DB::select($sql);
      return $user;
    }

    public function cancelRequest($userid){
        $user = $this->canCancel(\Auth::user()->id,$userid);
        if(!$user){
          return response()->json([
              'status'=>false, 'message'=>'Энэ хэрэглэгчтэй та найз болоогүй байна.'
          ]);
        }

        if($user[0]->status !== 0){
          return response()->json([
              'status'=>false, 'message'=>'Таны хүсэлтийг найзаар бүртгэсэн тул цуцлах боломжгүй байна.'
          ]);
        }

        FriendUpdates::where('friend_id', $user[0]->id)->delete();
        $status = Friends::find($user[0]->id)->delete();
        return response()->json(['dataid'=>"add_".$userid,
            'status'=>$status, 'btntext'=>trans('strings.add_friend')
        ]);
    }

    public function acceptRequest($userid){
        $checkeduser = $this->canCancel($userid, \Auth::user()->id);
        if(!$checkeduser){
          return response()->json([
              'status'=>false, 'message'=>'Хэрэглэгч найзын хүсэлтээ буцаасан байна.'
          ]);
        }
        $user = Friends::find($checkeduser[0]->id);
        $user->status = 1;
        $status = $user->save();

        if($status){
          $fupdate = new FriendUpdates();
          $fupdate->friend_id = $user->id;
          $fupdate->created_at = new \DateTime();
          $fupdate->status = $user->status;
          $fupdate->user_id = \Auth::user()->id;
          $fupdate->save();
        }

        return response()->json(['dataid'=>$userid,
            'status'=>$status, 'btntext'=>trans('strings.friend')
        ]);
    }

    public function friendRequest($userid){
        if($this->canRequest(\Auth::user()->id, $userid) > 0){
          return response()->json([
              'status'=>false, 'message'=>'Хүсэлт явуулах боломжгүй байна'
          ]);
        }

        $friend = new Friends();
        $friend->user_id = \Auth::user()->id;
        $friend->friend_user_id = $userid;
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
        return response()->json(['dataid'=>'can_'.$userid,
            'status'=>$status, 'btntext'=>trans('strings.cancel_friend')
        ]);
    }

    public function canRequest($userid, $friendid){
      $sql = "select count(*) too from friends s
	       where (s.friend_user_id = $userid and user_id = $friendid) or (s.friend_user_id = $friendid and user_id = $userid)";
      $count = DB::select($sql);
      return $count[0]->too;
    }

    public function friendsView(){
      return view('frontend.friendList');
    }
}
