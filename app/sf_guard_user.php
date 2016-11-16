<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class sf_guard_user extends Authenticatable
{
  protected $table = 'sf_guard_user';
  use Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'email_address', 'password', 'last_name', 'first_name', 'username','phone','phone2','address','zone_id','gender','created_at','profileName','username_canonical','email_canonical','confirmation_token','roles'
  ];
  public function likes()
  {
    return $this->hasMany('App\Like');
  }

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
      'password',
  ];
}
