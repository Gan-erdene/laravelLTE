<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
  protected $table = 'works';
  protected $primaryKey = 'id';

  public function proposalCount(){
      return $this->hasMany('App\WorkUserProposal', 'workid', 'id')->count();
  }
  public function likes()
  {
    return $this->hasMany('App\Like');
  }
  public function Likecount(){
    return Like::where('post_id',$this->id)->count();
  }

  public function comment(){
      return $this->hasMany('App\Models\Comment_post', 'workid', 'id')->get();
  }

  public function images(){
    return $this->hasMany('App\Models\WorkImages', 'work_id', 'id')->get();
  }

  public function userAvatar(){
    return $this->hasOne('App\sf_guard_user', 'id', 'userid');
  }
}
