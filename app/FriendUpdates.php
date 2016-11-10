<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FriendUpdates extends Model
{
  protected $table = 'friend_updates';
  protected $primaryKey = 'update_id';
  public $timestamps = false;
}
