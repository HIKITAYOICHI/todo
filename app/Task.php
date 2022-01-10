<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Status;
use Carbon\Carbon;

class Task extends Model
{
   protected $guarded = array('id');
   
   public static $rules = array(
       'body' => 'required', 
       );
    // Userモデルとの多対１でのリレーション
    public function user()
    {
    return $this->belongsTo('App\User');
    }
    
}
