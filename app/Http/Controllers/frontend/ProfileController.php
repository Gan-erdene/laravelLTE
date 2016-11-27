<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\sf_guard_user;
use App\Section;
use App\Works;
use Validator;
use DB;
use Image;
use App\Friends;

class ProfileController extends Controller
{
    public function index(Request $request){

      $user = sf_guard_user::find(\Auth::user()->id);
      $sections = $this->selectUserSecions();
      $parameter = $request->input('s');
      $categories = $this->getCategoryByUser(\Auth::user()->id);
      $fuController = new FindUserController;
      $friends = $fuController->friendList(0, 8);
      return view('frontend.edit_profile', [])
      ->with('user',$user)
      ->with('s',$parameter)
      ->with('categories',$categories)
      ->with('cover_right_friend',$friends)
      ->with('sections',$sections);
    }
    public function userprofile(Request $request){
      $id = $request->input('id');
          $user_show = sf_guard_user::find($id);

          $sections = Section::where('published', '1')->orderBy('order_id', 'asc')->get();
          $posts = Works::where('userid',$id)->orderBy('created_at','desc')->get();
          $finduser = new FindUserController;
          $cover_right_friend = $finduser->friendList(0, 8, $id);

        return view('frontend.userprofile')
          ->with('user_show',$user_show)
          ->with('sections',$sections)
          ->with('cover_right_friend', $cover_right_friend)
          ->with('posts',$posts);

    }
    public function userabout(Request $request){
      $id = $request->input('id');
        $user_about = sf_guard_user::find($id);
        $finduser = new FindUserController;
        $cover_right_friend = $finduser->friendList(0, 8, $id);
        return view('frontend.userabout')
        ->with('user_about',$user_about)
        ->with('cover_right_friend', $cover_right_friend);
    }
    public function userFriendsList(Request $request){
      $id = $request->input('id');
      $user_about = sf_guard_user::find($id);
      $finduser = new FindUserController;

      $friends = $finduser->friendList(0, 8, $id);


      $cover_right_friend = $finduser->friendList(0, 8, $id);


      return view('frontend.userFriendsList')
      ->with('user_about',$user_about)
      ->with('cover_right_friend', $cover_right_friend)
      ->with('friends',$friends);
    }

    public function selectUserSecions(){
      $sql = "select s.*, d.section_id, t.name as section_name from section s
          left join section_translation t on s.id = t.id and t.lang='mn'
          left join ( select distinct c.section_id from category c left join sf_guard_user_category w on c.id =w.catid where w.user_id = ".(\Auth::user()->id)." ) d on s.id = d.section_id
	       where s.published = 1 order by s.order_id desc";
      $list = DB::select($sql);
      return $list;
    }

    public function getCategoryByUser($user_id){
      $sql="select c.*, t.name catname, w.catid from category c
          	left join category_translation t on c.id = t.id and t.lang = 'mn'
          	left join sf_guard_user_category w on c.id = w.catid and w.user_id = $user_id
              where c.published = 1 and c.section_id in (select distinct c.section_id from category c left join sf_guard_user_category w on c.id =w.catid where w.user_id = $user_id )
              order by c.section_id asc, c.order_id asc";
      $list = DB::select($sql);
      return $list;
    }

    public function action(Request $request){




        $user = sf_guard_user::find(\Auth::user()->id);
        $user->last_name = $request->input('lastname');
        $user->first_name = $request->input('firstname');
        $user->email_address = $request->input('email');
        $user->register = $request->input('register');
        $user->location = $request->input('location');
        $user->about = $request->input('about');
        $user->gender = $request->input('gender');
        $user->work = $request->input('work');
        $user->ndd = $request->input('ndd');
        $user->emdd = $request->input('emdd');
        $user->birthday = $request->input('birthday');
        $user->ur_zadvar = $request->input('zadvar');
        $user->phone = $request->input('phone');
        $user->address  = $request->input('address');
        $user->update();



      return back()
        ->with('success','Амжилттай хадгалагдлаа.')
        ;
    }
    public function Cover(Request $request)
    {
        $user = sf_guard_user::find(\Auth::user()->id);
        if(isset($request->profileimage)){
          $image = $request->file('profileimage');
                $input['imagename'] = time().'.'.$image->getClientOriginalName();
                $destinationPath = public_path('uploads/profileimage');
                $img = Image::make($image->getRealPath());
                $img->resize(110, 110, function ($constraint) {
        		    $constraint->aspectRatio();
        		})->save($destinationPath.'/'.$input['imagename']);
            $user->profile_image = $input['imagename'];
        }
        if(isset($request->coverName)){
          $cover = $request->file('coverName');
                $input['cover'] = time().'.'.$cover->getClientOriginalName();
                $destinationPath = public_path('uploads/coverimage');
                $img = Image::make($cover->getRealPath());
                $img->resize(800, null, function ($constraint) {
                  $constraint->aspectRatio();
                  $constraint->upsize();
        		})->save($destinationPath.'/'.$input['cover']);
          $user->coverName = $input['cover'];
        }
         $user->update();
          return redirect('/frontend/home');
    }
}
