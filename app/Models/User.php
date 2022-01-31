<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Task;
use App\Models\Comment;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.->orderBy('deadline', 'desc');
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // Taskモデルとの１対多でのリレーション
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
        
    }
    
    // Commentモデルとの１対多でのリレーション
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
        
    }
    
    public function orderbytasksdesc()
    {
     return $this->hasMany('App\Models\Task')->orderBy('deadline', 'desc');
    }
    
    public function orderbytasksasc()
    {
     return $this->hasMany('App\Models\Task')->orderBy('deadline', 'asc');
    }
    
}
