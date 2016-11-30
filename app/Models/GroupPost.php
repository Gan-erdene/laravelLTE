<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPost extends Model
{
  protected $table = 'group_post';
  protected $primaryKey = 'id';

  public function postUser(){
        return $this->hasOne('App\sf_guard_user', 'id', 'user_id');
  }
  public function likes()
  {
    return $this->hasMany('App\GroupLike');
  }
  public function Likecount(){
    return GroupLike::where('post_id',$this->id)->count();
  }
}
