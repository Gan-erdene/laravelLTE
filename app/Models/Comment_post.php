<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment_post extends Model
{
  protected $table = 'comment_post';
  protected $primaryKey = 'id';

  public function user()
  {
    return $this->hasOne('App\sf_guard_user','id','user_id');
  }
}
