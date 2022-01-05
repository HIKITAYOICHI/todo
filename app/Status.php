<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Status extends Model
{
    //
    
    // Taskモデルとの１対多でのリレーション
    public function tasks()
    {
        return $this->hasMany('App\Task');
        
    }

}
