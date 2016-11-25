<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\GroupUsers;
class GroupController extends Controller
{
    public function action(Request $request){

      $string = $request->input('action');
      $action = explode('_', $string);

      switch($action[0]) {
        case 'create': return $this->createGroup($request);
        case 'add': return $this->GroupRequest($action[1]);
        case 'can' : return $this->CancelRequest($action[1]);
        case 'ext' : return $this->ExitRequest($acton[1]);
        case 'acc' : return $this->AcceptRequest($action[1]);
        default: break;
      }
    }
    public $status = [
      '0'=>'Та хүсэлт илгээсэн байна',
      '1'=>'Та энэ грүппын гишүүн байна',
      '2'=>'Та энэ грүппын админ байна'
    ];
    public function AcceptRequest($userid)
    {
          $add_group_user = GroupUsers::where('user_id', $userid)->where('status', 0)->first();
          if($add_group_user){
            $add_group_user->status = 1;
            $add_group_user->save();
          }

          return response()->json(['status'=>true]);



    }
    public function GroupRequest($groupid){
        $oldhist = GroupUsers::where('user_id', \Auth::user()->id)->where('group_id', $groupid)->first();

        if( $oldhist ){
            return response()->json(['dataid'=>'can_'.$groupid,
                'status'=>false, 'message'=>$this->status[$oldhist->status]
            ]);
        }

      return $this->addGroupUser($groupid);
    }

    public function viewGroup($groupid){
      $group = Groups::find($groupid);


      $groupUser = GroupUsers::where('user_id',\Auth::user()->id)->where('group_id',$groupid)->first();
      if($groupUser){
        if($groupUser->status === 2){

                  $list_users = GroupUsers::where('group_id',$groupid)->where('status',0)->get();
              return view('frontend.group.view_group',['group'=>$group,'groupuser'=>$groupUser,'list_users'=>$list_users]);


        }
        elseif($groupUser->status === 1){
          return view('frontend.group.view_group', ['group'=>$group, 'groupuser'=>$groupUser]);
        }
        else{
return view('frontend.group.view_group', ['group'=>$group, 'groupuser'=>$groupUser]);
        }

      }


    return view('frontend.group.view_group', ['group'=>$group, 'groupuser'=>$groupUser]);




    }
    public function addGroupUser($groupid){
      $grouprequest = new GroupUsers();
      $grouprequest->group_id = $groupid;
      $grouprequest->user_id = \Auth::user()->id;
      $grouprequest->status = '0';
      $status = $grouprequest->save();

      return response()->json(['dataid'=>'can_'.$groupid,
          'status'=>$status, 'btntext'=>'<i class="fa fa-user-times"></i>Хүсэлтийг зогсоох'
      ]);
    }

    public function CancelRequest($group_id){
      $group = GroupUsers::where('group_id',$group_id)->where('user_id',\Auth::user()->id)->first();
      if($group){
          $group->delete();
          return response()->json(['dataid'=>'add_'.$group_id,
              'status'=>true, 'btntext'=>'<i class="fa fa-user-plus"></i>Гишүүн болох'
          ]);
      }
      return response()->json([
          'status'=>false, 'message'=>'Та энэ группын гишүүн биш байна'
      ]);
    }
    public function ExitRequest($group_id){
        $exit_group = GroupUsers::where('group_id',$group_id)->where('user_id',\Auth::user()->id)->first();
        if($exit_group){
          $exit_group->delete();
          return response()->json(['dataid'=>'add_'.$group_id,
            'status'=>true, 'btntext'=>'<i class="fa fa-user-plus"></i>Гишүүн болох'
        ]);
        }
        return response()->json([
            'status'=>false, 'message'=>'Та энэ группын гишүүн биш байна'
        ]);
    }



    public function createGroup($request){
      $user_id = \Auth::user()->id;
      $group_name = $request->input('group_name');
      $description = $request->input('description');
      $group = new Groups();
      $group->group_name = $group_name;
      if($description)
        $group->description = $description;
      $group->created_by = $user_id;
      $status = $group->save();
      if($status){
        $groupuser = new GroupUsers();
        $groupuser->status = 2;//group admin
        $groupuser->group_id = $group->id;
        $groupuser->user_id = $user_id;
        $groupuser->save();
        return redirect()->route('viewGroup',['groupid'=>$group->id]);
      }
    }


}
