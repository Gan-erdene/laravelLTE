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
}
