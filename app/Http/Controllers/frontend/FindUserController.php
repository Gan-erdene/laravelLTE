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

    /**
    * friend status
    * 0 - sent request
    * 1 - friends
    * 2 - decline friends
    * 3 - remove friends
    * 4 - cancel request
    */
    public function index(Request $request){
      $page = $this->pageNumber( $request->input("page") );
      $start = ($page - 1) * 16 + 1;
      $end = $page * 16;
      $users = $this->getUnfriendList($start, $end);
      return view('frontend.find_user')
        ->with('page', $page)
        ->with('users', $users);
    }

    public function pageNumber($page){
      if(is_numeric($page)){
        return $page;
      }
      return 1;
    }

    public function getUnfriendList($start, $end){
      $sql = "SELECT S.id, S.last_name, S.first_name, S.email_address, F.STATUS user_status, s.profile_image, V.STATUS friend_status FROM sf_guard_user S
	               LEFT JOIN friends F ON S.id = F.user_id and F.friend_user_id = ".\Auth::user()->id."
                 LEFT JOIN friends V ON S.id = V.friend_user_id and V.user_id = ".\Auth::user()->id." WHERE
              S.ID <> ".\Auth::user()->id." and 1=case when V.status =  1 or F.status = 1 then 0 else 1 end order by S.first_name ";
      $list = DB::select($sql);
      return $list;
    }

    public function friendList($start, $end){
      $userid = \Auth::user()->id;
      $sql = "select u.last_name, h.listid, u.first_name, u.id, u.profile_image, h.uid from sf_guard_user u
                  left join (select case when s.user_id = $userid then s.friend_user_id else s.user_id end uid, s.id as listid from friends s where (s.user_id=$userid or s.friend_user_id = $userid) and s.status = 1) h on u.id = h.uid where h.uid is not null and u.id <> $userid limit $start, $end";
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
        case 'rem': return $this->removeFriend($action[1]);
        case 'flist' :
          $list = $this->friendList(0,8);
          $html = view('frontend.chatFriend', ['list'=>$list]);
        return response()->json(['html'=>$html->render()]);
        default:break;
      }
    }

    public function removeFriend($friendlistid){
      $friend = Friends::find($friendlistid);
      if(!$friend and $friend->status !== 1){
        return response()->json([
            'status'=>false, 'message'=>trans('strings.mess_not_friend')
        ]);
      }
      $user = Friends::find($friendlistid);
      $user->status = 3;
      $status = $user->update();

      if($status){
        $fupdate = new FriendUpdates();
        $fupdate->friend_id = $user->id;
        $fupdate->created_at = new \DateTime();
        $fupdate->status = $user->status;
        $fupdate->user_id = \Auth::user()->id;
        $fupdate->save();
      }
      $sendid = $friend->user_id === \Auth::user()->id ? \Auth::user()->id : $friend->friend_user_id;
      return response()->json(['dataid'=>'add_'.$sendid,
          'status'=>$status, 'btntext'=>trans('strings.add_friend')
      ]);
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
      $status = $user->update();

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

    public function canCancel($userid, $friendid){
      $sql = "select s.* from friends s
	       where (s.friend_user_id = $userid and user_id = $friendid) or (s.friend_user_id = $friendid and user_id = $userid)";
      $user = DB::select($sql);
      return $user;
    }

    public function cancelRequest($userid){
        $friendtable = $this->canCancel(\Auth::user()->id,$userid);
        if(!$friendtable or ($friendtable[0]->status === 2 or $friendtable[0]->status === 3)){
          return response()->json([
              'status'=>false, 'message'=>'Энэ хэрэглэгчтэй та найз болоогүй байна.'
          ]);
        }

        if($friendtable[0]->status === 1){
          return response()->json([
              'status'=>false, 'message'=>'Таны хүсэлтийг найзаар бүртгэсэн тул цуцлах боломжгүй байна.'
          ]);
        }

        $ffriend = Friends::find($friendtable[0]->id);
        $ffriend->status = 4;
        $status = $ffriend->update();
        if($status){
          $fupdate = new FriendUpdates();
          $fupdate->friend_id = $friendtable[0]->id;
          $fupdate->created_at = new \DateTime();
          $fupdate->status = $ffriend->status;
          $fupdate->user_id = \Auth::user()->id;
          $fupdate->save();
        }

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
        $oldhist = $this->canRequest(\Auth::user()->id, $userid);
        if(isset($oldhist[0]) and $oldhist[0]->status === 1){
          return response()->json([
              'status'=>false, 'message'=>trans('strings.mess_friend')
          ]);
        }elseif( isset($oldhist[0]) and $oldhist[0]->status === 0 ){
          return response()->json([
              'status'=>false, 'message'=>trans('strings.mess_sent_request')
          ]);
        }elseif( isset($oldhist[0]) ){
          $friend = Friends::find($oldhist[0]->id);
          $friend->status = 0;
          $status = $friend->update();
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
      $sql = "select * from friends s
	       where (s.friend_user_id = $userid and user_id = $friendid) or (s.friend_user_id = $friendid and user_id = $userid)";
      $count = DB::select($sql);
      return $count;
    }

    public function friendsView(){
      $list = $this->friendList(0,8);
      return view('frontend.friendList')
        ->with('friends', $list);
    }
}
