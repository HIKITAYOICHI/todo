<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        // idの取り出し
        $id = $request->input('task_id');
        $task = Task::find($id);
        return view('user.tasks.comment', compact('task'));
    }
    
    public function store(Request $request)
    {
        $task = new Task;

        $form = $request->all();

        unset($form['_token']);

        $task->fill($form);

        $task->user_id = $request->user()->id;

        $task->save();


    }
}
