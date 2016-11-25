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
      $sql = "select S.id, f.friend_user_id, S.last_name, S.first_name, S.email_address, F.status, S.work, S.profile_image  from sf_guard_user S
        left join friends f on S.id = f.friend_user_id
        where ( f.friend_user_id <> ".\Auth::user()->id. " and f.status not in ( 2, 6, 4, 5 ) ) or  f.user_id is null  order by S.first_name limit $start, $end";
      $list = DB::select($sql);
      return $list;
    }

    public function friendList($start, $end, $userid = 0){
      $userid = $userid === 0 ? \Auth::user()->id : $userid;
      $list = Friends::where('user_id', $userid)->whereIn('status', array(2, 6))->get();
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

    public function removeFriend($friend_user_id){

      $friend = Friends::where('user_id', \Auth::user()->id)->where( 'friend_user_id', $friend_user_id )->first();
      if(isset($friend->status) === false){
        return response()->json([
            'status'=>false, 'message'=>trans('strings.mess_not_friend')
        ]);
      }
      if( $friend->status === 2 or $friend->status === 6 ){
        $friend->status = 7; //naizaas hassan
        $friend->update();

        $_friend = Friends::where('friend_user_id', \Auth::user()->id)->where('user_id', $friend_user_id)->first();
        $_friend->status = 3;
        $_friend->update();

        $fupdate = new FriendUpdates();
        $fupdate->created_at = new \DateTime();
        $fupdate->status = $friend->status;
        $fupdate->user_id = \Auth::user()->id;
        $fupdate->save();

        return response()->json(['dataid'=>'add_'.$friend_user_id,
            'status'=>true, 'btntext'=>trans('strings.add_friend')
        ]);
      }

      return response()->json(['dataid'=>'can_'.$userid,
          'status'=>false, 'btntext'=>$this->status[$oldhist->status]
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

    public function createHistory($status){
      $fupdate = new FriendUpdates();
      $fupdate->created_at = new \DateTime();
      $fupdate->status = $status;
      $fupdate->user_id = \Auth::user()->id;
      $fupdate->save();
    }

    public function cancelRequest($friendid){
        $friend = Friends::where('user_id', \Auth::user()->id)->where('friend_user_id', $friendid)->first();
        if($friend->status === 0 or $friend->status === 1 or $friend->status === 8 or $friend->status === 9){
          $friend->status = 8; //huselt butsaasan
          $friend->update();
          $_friend = Friends::where('friend_user_id', \Auth::user()->id)->where('user_id', $friendid)->first();
          $_friend->status = 9; //huselt butsaagdsan
          $_friend->update();

          $this->createHistory($friend->status);

          return response()->json(['dataid'=>"add_".$friendid,
              'status'=>true, 'btntext'=>trans('strings.add_friend')
          ]);
        }

        if(!$friend){
          return response()->json([
              'status'=>false, 'message'=>'Хүсэлт үүсээгүй байна.'
          ]);
        }

        return response()->json(['dataid'=>'can_'.$friendid,
            'status'=>true, 'btntext'=>$this->status[$friend->status]
        ]);
    }

    public function acceptRequest( $userid ){
        $user = Friends::where('user_id', \Auth::user()->id)->where('friend_user_id', $userid)->first();
        if(!$user){
          return response()->json([
              'status'=>false, 'message'=>'Хэрэглэгч найзын хүсэлт явуулаагүй эсвэл буцаасан байна.'
          ]);
        }

        if($user->status === 1){
          $user->status = 2; //zuwshuursun
          $status = $user->save();

          if($status){

            $_user = Friends::where('friend_user_id', \Auth::user()->id)->where('user_id', $userid)->first();
            $_user->status = 6; //naiz bolson
            $_user->update();

            $fupdate = new FriendUpdates();
            $fupdate->created_at = new \DateTime();
            $fupdate->status = $user->status;
            $fupdate->user_id = \Auth::user()->id;
            $fupdate->save();

            return response()->json(['dataid'=>$userid,
                'status'=>$status, 'btntext'=>'<i class="fa fa-user-plus"></i>Зөвшөөрөх'
            ]);
          }
        }

        return response()->json([
            'status'=>false, 'btntext'=>$this->status[$user->status]
        ]);

    }

    public function addFriend($userid){
      $friend = new Friends();
      $friend->user_id = \Auth::user()->id;
      $friend->friend_user_id = $userid;
      $friend->created_at = new \DateTime();
      $friend->status = 0;
      $status = $friend->save();
      if($status){
        $fupdate = new FriendUpdates();
        $fupdate->created_at = new \DateTime();
        $fupdate->status = $friend->status;
        $fupdate->user_id = \Auth::user()->id;
        $fupdate->save();

        $_friend = new Friends();
        $_friend->user_id = $userid;
        $_friend->friend_user_id = \Auth::user()->id;
        $_friend->created_at = new \DateTime();
        $_friend->status = 1;//huselt irsen
        $_friend->save();
      }

      return response()->json(['dataid'=>'can_'.$userid,
          'status'=>$status, 'btntext'=>trans('strings.cancel_request')
      ]);
    }
    public $status = [
      '0'=>'Та хүсэлт илгээсэн байна',
      '1'=>'Тань уруу хүсэлт явуулсан байна',
      '2'=>'Та энэ хүнтэй болсон байна',
      '6'=>'Та энэ хүнтэй болсон байна',
      '3'=>'Та энэ хүнтэй найз биш байна',
      '4'=>'Та блок хийсэн байна',
      '5'=>'Таныг блок хийсэн байна',
      '7'=>'Таныг найзаас хассан байна',
      '8'=>'Хүсэлт буцаасан',
      '9'=>'Хүсэлт буцаагдсан'
    ];

    public function friendRequest($userid){
        $oldhist = Friends::where('user_id', \Auth::user()->id)->where('friend_user_id', $userid)->first();
        if( $oldhist ){
          if($oldhist->status === 3 or $oldhist->status === 7 or $oldhist->status === 8 or $oldhist->status === 9){
            $oldhist->status = 0; // huselt ilgeesen
            $status = $oldhist->update();
            if($status){

              $friend = Friends::where('friend_user_id', \Auth::user()->id)->where('user_id', $userid)->first();
              $friend->status = 1; // huselt irsen
              $friend->update();
              $this->createHistory($friend->status);
            }
            return response()->json(['dataid'=>'can_'.$userid,
                'status'=>$status, 'btntext'=>trans('strings.cancel_request')
            ]);
          }else{

            return response()->json(['dataid'=>'can_'.$userid,
                'status'=>true, 'btntext'=>$this->status[$oldhist->status]
            ]);
          }
        }

        return $this->addFriend($userid);
    }

    public function canRequest($userid, $friendid){
      $sql = "select * from friends s
	       where (s.friend_user_id = $userid and user_id = $friendid) or (s.friend_user_id = $friendid and user_id = $userid)";
      $count = DB::select( $sql );
      return $count;
    }

    public function friendsView(){
      $id = \Auth::user()->id;
      $user_about = sf_guard_user::find($id);
      $finduser = new FindUserController;
      $friends = $this->friendList(0,8);
      $cover_right_friend = $finduser->friendList(0, 8, $id);
      return view('frontend.friendList')
      ->with('user_about',$user_about)
      ->with('cover_right_friend', $cover_right_friend)
      ->with('friends',$friends);

    }
}
