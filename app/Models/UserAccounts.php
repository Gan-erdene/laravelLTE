<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccounts extends Model
{
  protected $table = 'user_accounts';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
