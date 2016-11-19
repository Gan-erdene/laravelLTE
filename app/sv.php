<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sv extends Model
{
  protected $table = 'work_user_sv';
  protected $primaryKey = 'id';
  public function Likecount(){
    return Like::where('post_id',$this->id)->count();
  }
}
