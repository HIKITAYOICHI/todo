<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Task;
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
        
        // return redirect('admin/tasks/show',)->with("task_id",$request->task_id);
        return redirect('admin/tasks/show/'.$request->task_id);
        
    }
    
    public function delete(Request $request)
    {
        // Modelからデータの取得
        $comment = Comment::find($request->id);
        $task_id = $comment->task->id;
        // 削除
        $comment->delete();
        //戻る処理　
        return redirect('admin/tasks/show/'.$task_id);
        
    }
}