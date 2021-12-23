<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;

class TaskController extends Controller
{
    public function add()
    {
        return view('tasks.index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //  index　addとダブり
    public function index()
    {
        return view('tasks.index');
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
    public function edit()
    {
        return view('tasks.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return redirect('/tasks/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Modelの取得
      $task = TASK::find($request->id);
      // 削除
      $task->delete();
      return redirect('/tasks');
        //消す処理と戻る処理　
    }
}
