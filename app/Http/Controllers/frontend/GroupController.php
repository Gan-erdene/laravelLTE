<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Groups;
use App\Models\GroupUsers;
class GroupController extends Controller
{
    public function action(Request $request){
      switch ($request->input('action')) {
        case 'create': return $this->createGroup($request);

        default: break;
      }
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

    public function viewGroup($groupid){
      $group = Groups::find($groupid);
      $groupUser = GroupUsers::where('user_id',\Auth::user()->id)->where('group_id',$groupid)->first();
      return view('frontend.group.view_group', ['group'=>$group, 'groupuser'=>$groupUser]);
    }
}
