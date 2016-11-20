<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TxnStatusAction extends Model
{
  protected $table = 'txn_status_action';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
