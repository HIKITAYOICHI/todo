<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Admin;

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
    
    // Adminモデルとの多対１でのリレーション
    public function admin()
    {
    return $this->belongsTo('App\Admin');
    }
    
}
