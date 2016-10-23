<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
  protected $table = 'category_translation';
  protected $primaryKey = 'id';
  public $timestamps = false;
}
