<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SfGuardUserCategory extends Model
{
  protected $table = 'sf_guard_user_category';
  protected $primaryKey = 'id';
  public $timestamps = false;

  public function section(){
    return $this->hasOne('App\Section', 'id', 'section_id');
  }

  public function category(){
    return $this->hasOne('App\Category', 'id', 'catid');
  }
}
