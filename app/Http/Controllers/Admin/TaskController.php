<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use App\Models\Image;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskEditRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EditSent;
use Storage;

class TaskController extends Controller
{
    public function add()
    {
        return redirect('admin/tasks');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search_title = $request->search_title;
        $by = isset($request->sortby) ? $request->sortby : "asc";
        
        if ($search_title != '') {
            // 検索されたら検索結果を取得する
            $tasks = Task::where('title', $search_title)->paginate(10);
        }
        
        else {
            if ($by == '降順'){
                //   $by に降順が入ればdesc
                $tasks = Task::all()->sortBydesc('deadline')->paginate(10);
            }
            else if($by == '昇順'){
                //   $by に昇順が入ればasc
                $tasks = Task::all()->sortBy('deadline')->paginate(10);
            }
            else {
                // それ以外は全件取得
                $tasks = Task::all()->paginate(10);
            }
        }
        return view('admin.tasks.index', ['tasks' => $tasks, 'search_title' => $search_title]);
    }    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('admin/tasks');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        // データベースに保存
        $task = new Task;
        $form = $request->all();
        unset($form['_token']);
        $task->fill($form);
        // $task->deadline = '2022-01-01';
        $task->user_id = $request->user()->id;
        $task->save();
        
        $tasks = Task::orderBy('deadline', 'desc')->get();
        
        // 画像の保存
        for ($i=0;$i<=3;$i++) {
            
            $image = $request->file('image' . $i);
            
            if (isset($image)) {
            
                $image = new Image;
                $path = Storage::disk('s3')->putFile('/', $task_form['image' . $i], 'public');
                $image->name = Storage::disk('s3')->url($path);
                $image->task_id = $task->id;
                $image->save();
            } 
        }
        
        return redirect('admin/tasks');
        //select * from taskmanagement.tasks;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        
        // idの取り出し
        // $id = $request->input('id');
        $task = Task::find($id);
        
        return view('admin.tasks.show', compact('task'));
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
        // $task->status_id = 0;
      
        return view('admin.tasks.edit', ['task_form' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskEditRequest $request)
    {
        
        // Modelからデータの取得
        $task = Task::find($request->id);
        // 送信されてきたフォームデータの格納
        $task_form = $request->all();
        unset($task_form['_token']);
        //データの上書き
        $task->fill($task_form);
        // $task->deadline = '2022-01-01';
        $task->save();
        // 画像の登録
        for ($i=0;$i<=2;$i++) {
            
            $image = $request->file('image' . $i);
            
            if (isset($image)) {
                
                $path = Storage::disk('s3')->putFile('/', $task_form['image' . $i], 'public');
                
                if (isset($task->images[$i])){
                    $task->images[$i]->name = Storage::disk('s3')->url($path);
                    $task->images[$i]->save();
                } else {
                    $image = new Image;
                    
                    $image->name = Storage::disk('s3')->url($path);
                    $image->task_id = $task->id;
                    $image->save();
                }
                
            } else {
                
                $task_form['stored_image' . $i];
                
            }
        }
        
        return redirect('admin/tasks');
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
      return redirect('admin/tasks');
        
    }
}