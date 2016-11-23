<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
  protected $table = 'friends';
  protected $primaryKey = 'id';
  public $timestamps = false;


  public function friend(){
    return $this->hasOne('App\sf_guard_user','id','friend_user_id');
  }
}
