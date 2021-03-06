<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Admin;
use App\Models\Comment;

class Task extends Model
{
    protected $guarded = array('id');
    
    protected $fillable = ['user_id','title','body', 'status_name', 'deadline'];
   
    public static $rules = array(
       'body' => 'required', 
       );
       
    // Userモデルとの多対１でのリレーション
    public function user()
    {
    return $this->belongsTo('App\Models\User');
    }
    
    // Adminモデルとの多対１でのリレーション
    public function admin()
    {
    return $this->belongsTo('App\Models\Admin');
    }
    
    // Commentモデルとの１対多でのリレーション
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
        
    }
    
    // Imageモデルとの１対多でのリレーション
    public function images()
    {
        return $this->hasMany('App\Models\Image');
        
    }
}
