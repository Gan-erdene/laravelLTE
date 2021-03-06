<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkUserProposal extends Model
{
  protected $table = 'work_user_proposal';
  protected $primaryKey = 'id';

  public function user(){
    return $this->hasOne('App\sf_guard_user', 'id', 'user_id');
  }

  public function comment(){
    return $this->hasMany('App\Comment', 'prop_id', 'id')->get();
  }

  public function txns(){
    return $this->hasMany('App\Models\WorkTxn', 'proposalid', 'id')->get();
  }

  public function rates(){
    return $this->hasOne('App\Models\Poll', 'proposalid', 'id');
  }
}
