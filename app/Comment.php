<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $table = 'comment';
  protected $primaryKey = 'id';

  public function user()
  {
    return $this->hasOne('App\sf_guard_user','id','user_id');
  }
}
