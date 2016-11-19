<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
  protected $table = 'post';
  protected $primaryKey = 'id';

  public function likes()
  {
    return $this->hasMany('App\Like');
  }
}
