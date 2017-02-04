<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class sf_guard_user extends Authenticatable
{
  protected $table = 'sf_guard_user';
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'email_address', 'password', 'last_name', 'first_name', 'username','phone','phone2','address','zone_id','gender','created_at','profileName','username_canonical','email_canonical','confirmation_token','roles'
  ];

  public function friend(){
      return $this->hasMany('App\Friends', 'friend_user_id', 'id')->where('user_id', \Auth::user()->id)->first();
  }

  public function posts()
  {
    return $this->hasMany('App\post');
  }
  public function likes()
  {
    return $this->hasMany('App\Like','user_id','id');
  }

  public function getShortName(){
    return $this->first_name." .".substr($this->last_name, 0, 1);
  }
  public function socialProviders(){
      return $this->hasMany('App\SocialProvider','user_id','id');
  }

  public function getAvatar(){
    if($this->profile_image){
        return "/uploads/profileimage/".$this->profile_image;
    }
    return "/frontend/img/Profile/default-avatar.png";
  }
  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password',
  ];
}
