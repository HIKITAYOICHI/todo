<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
use App\Models\Image;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function create(Request $request)
    {
        //
    }
    
    public function store(CommentRequest $request)
    {
        $comment = new Comment;
        $form = $request->all();
        unset($form['_token']);
        $comment->fill($form);
        $comment->save();
        $id = $request->input('task_id');
        $task = Task::find($id);
        
        return redirect('user/tasks/show/'.$request->task_id);
    }
    
     public function delete(Request $request)
    {
        // Modelからデータの取得
        $comment = Comment::find($request->id);
        $task_id = $comment->task->id;
        // 削除
        $comment->delete();
        //リダイレクト
        return redirect('user/tasks/show/'.$task_id);
        
    }
}