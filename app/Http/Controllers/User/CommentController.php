<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class CommentController extends Controller
{
    public function create()
    {
        $task = Task::find(1);
        return view('user.tasks.comment', compact('task'));
    }
    
    public function store()
    {
        // $task = new Task;

        // $form = $request->all();

        // unset($form['_token']);

        // $task->fill($form);

        // $task->user_id = $request->user()->id;

        // $task->save();


    }
}
