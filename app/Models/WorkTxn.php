<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkTxn extends Model
{
  protected $table = 'work_txn';
  protected $primaryKey = 'id';

  public function accounts(){
    return $this->hasMany('App\Models\UserAccounts', 'user_id', 'receive_user_id')->get();
  }

  public function getStatus(){
    return TxnStatusAction::where('worktxnid', $this->id)->orderBy('id', 'desc')->first();
  }
}
