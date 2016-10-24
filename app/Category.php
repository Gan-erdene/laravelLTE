<?php

namespace App;

use App\CategoryTranslation;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{

  protected $table = 'category';
  protected $primaryKey = 'id';

  public function CategoryTranslationJoin(){
    return $this->hasOne('App\CategoryTranslation','id','id');
  }
  public function SectionTranslationJoin(){
    return $this->hasOne('App\Section','id','section_id');
  }
}
