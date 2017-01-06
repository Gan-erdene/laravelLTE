<?php

namespace App\Helper;

use Illuminate\Database\Eloquent\Model;
use DB;
use \App\Models\SfGuardUserSettings;
use \App\Friends;
class DatabaseHelper extends Model
{
  public static function canSee($friendId, $fieldName)
  {

      $yourId = \Auth::user()->id;
      $sett = SfGuardUserSettings::where('user_id', $friendId)->where('field_name', $fieldName)->first();

      if($friendId === $yourId){
        return true;
      }

      if($sett){
        switch ($sett->status) {
          case 'me': return false;
          case 'all': return true;
          case 'friends': $check = Friends::where('user_id', $friendId)->where('friend_user_id', $yourId)->first();
            if($check){
              return true;
            } break;
          default: return false;
        }
      }
      return false;
  }
}
