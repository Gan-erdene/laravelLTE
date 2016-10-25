<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
  protected $table = 'section';
  protected $primaryKey = 'id';

  public function sectype(){
    return $this->hasOne('App\sectiontype', 'id', 'type_id');
  }

  public function secTrans($lang){
    return $this->hasMany('App\SectionTranslation', 'id', 'id')->where('lang', $lang)->first();
  }

  public function isPublished(){
    return $this->published == 1 ? 'Харуулна' : 'Харуулахгүй';
  }
}
