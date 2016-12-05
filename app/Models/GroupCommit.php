<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupCommit extends Model
{
  protected $table = 'group_commit';
  protected $primaryKey = 'id';
  
  public function user()
  {
    return $this->hasOne('App\sf_guard_user','id','user_id');
  }
}
