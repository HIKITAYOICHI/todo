<?php

namespace App\Http\Controllers\User;

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
        
        // return redirect('user/tasks/show',)->with("task_id",$request->task_id);
        return redirect('user/tasks/show?id='.$request->task_id);
    }
    
     public function delete(Request $request)
    {
        // $id = $request->input('comment_id');
        // $comment = Comment::find($id);
       // Modelからデータの取得
        $comment = Comment::find($request->id);
        // 削除
        $comment->delete();
        //戻る処理　
        return redirect('user/tasks/show?id='.$request->task_id);
        
    }
}

// $comments = App\Models\Comment::paginate(10);