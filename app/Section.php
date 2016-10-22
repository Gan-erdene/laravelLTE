<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
  protected $table = 'section_type';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
