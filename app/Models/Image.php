<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Image extends Model
{
    
    // Taskモデルとの多対１でのリレーション
    public function task()
    {
    return $this->belongsTo('App\Models\Task');
    }
}
