<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Status;

class Task extends Model
{
   protected $guarded = array('id');

    public static $rules = array(
        'body' => 'required', 
        );
    
    
    // Userモデルとのリレーション
    public function user()
    {
    return $this->belongsTo('App\User');
    }
    // Statusモデルとのリレーション
    public function status()
    {
    return $this->belongsTo('App\Status');
    }
}
