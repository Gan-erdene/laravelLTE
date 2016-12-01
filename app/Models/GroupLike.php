<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupLike extends Model
{
    //
    protected $table = "group_like";
    protected $primaryKey = "id";

    public function user()
    {
      return $this->hasOne('App\sf_guard_user','id','user_id');
    }
    public function post()
    {
      return $this->hasOne('App\Models\GroupPost','id','post_id');
    }
}
