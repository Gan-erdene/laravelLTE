<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkCategories extends Model
{
  protected $table = 'work_categories';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
