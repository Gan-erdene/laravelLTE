<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  protected $table = 'likes';
  protected $primaryKey = 'id';

    public function user()
    {
      return $this->hasOne('App\sf_guard_user','id','user_id');
    }
    public function post()
    {
      return $this->hasOne('App\Works','id','post_id');
    }

}
