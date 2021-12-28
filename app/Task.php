<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

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
}
