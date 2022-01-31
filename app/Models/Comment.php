<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\User;

class Comment extends Model
{ 
    protected $fillable = ['comment','task_id','user_id'];
    
    // Taskモデルとの多対１でのリレーション
    public function task()
    {
    return $this->belongsTo('App\Models\Task');
    }
    
    // Userモデルとの多対１でのリレーション
    public function user()
    {
    return $this->belongsTo('App\Models\User');
    }
    
    
}
