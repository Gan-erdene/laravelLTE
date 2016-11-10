<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{
  protected $table = 'friends';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
