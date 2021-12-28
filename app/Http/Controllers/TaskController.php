<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;

class TaskController extends Controller
{
    public function add()
    {
        // $tasks = Task::where('user_id', Auth::user()->id) ⇦のコマンドでも動くがリレーションをしてるので
        // indexの＠foreach文にAuth::user()->を入れて id引っ張ってこれるようになっている
        return view('tasks.index');
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索結果の取得
          $posts = Task::where('title', $cond_title)->get();
      } else {
          $posts = Task::all();
      }
      return view('tasks.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('/tasks');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // session()->flash('flash_message', '投稿が完了しました');
        echo "完了";
        
        // データベースに登録できる処理入れる
        //mysqlでデータベースに保存されてるか確認
        
        
        $task = new Task;
        $form = $request->all();
        unset($form['_token']);
        $task->fill($form);
        $task->status_id = 0;
        $task->user_id = $request->user()->id;
        $task->save();
        
        return redirect('/tasks');
        
        
        //select * from taskmanagement.tasks;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        // Modelからデータの取得
        $task = Task::find($request->id);
        $task->status_id = 0;
      
        return view('tasks.edit', ['task_form' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        // Modelからデータの取得
        $task = Task::find($request->id);
        // 送信されてきたフォームデータの格納
        $task_form = $request->all();
        unset($task_form['_token']);
        //データの上書き
        $task->fill($task_form);
        $task->status_id = 0;
        $task->save();
        
        return redirect('/tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // Modelからデータの取得
      $task = Task::find($request->id);
      // 削除
      $task->delete();
      //戻る処理　
      return redirect('/tasks');
        
    }
}
