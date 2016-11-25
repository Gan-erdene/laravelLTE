<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupUsers extends Model
{
    protected $table = "group_users";
    protected $primaryKey = "id";

    public function group(){
      return $this->hasOne('App\Models\Groups', 'id', 'group_id');
    }
    public function group_user(){
      return $this->hasOne('App\sf_guard_user','id','user_id');
    }
}
