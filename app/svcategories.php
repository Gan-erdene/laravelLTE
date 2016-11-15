<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class svcategories extends Model
{
  protected $table = 'work_user_categories';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
