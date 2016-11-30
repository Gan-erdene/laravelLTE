<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkCategories extends Model
{
  protected $table = 'work_categories';
  protected $primaryKey = 'id';
  public $timestamps = false;

  public function category(){
    return $this->hasOne('App\Category', 'id', 'catid');
  }

  public function work(){
    return $this->hasOne('App\Works', 'id', 'workid');
  }
}
