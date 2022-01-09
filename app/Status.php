<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class Status extends Model
{
    //
    
    // Taskモデルとの１対多でのリレーション
    public function tasks()
    {
        return $this->hasMany('App\Task');
        
    }

}
