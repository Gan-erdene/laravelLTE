<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkFiles extends Model
{
  protected $table = 'work_files';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
