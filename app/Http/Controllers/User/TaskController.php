<?php

namespace App\Http\Controllers\User;

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
        // $tasks = Task::where('user_id', Auth::user()->id) ⇦のコマンドでも動くがリレーションをしてるので
        // indexの＠foreach文にAuth::user()->を入れて id引っ張ってこれるようになっている
        // $tasks = Task::where('user_id', Auth::user()->id)->where('tatle' ,$search_title)    ⇦のコマンドでも動くがリレーションをしてるので
        // indexの＠foreach文にAuth::user()->tasks(モデル名)を入れて id引っ張ってこれるようになっている
        return redirect('user/tasks');
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
              //   ユーザー情報取得　関連するユーザーのタスク取得　タイトルで絞り込み
              $tasks = Auth::user()->tasks->where('title', $search_title)->paginate(5);
        } 
        else {
            if ($by == '降順'){
                 //   $by に降順が入ればdesc
                 $tasks = Auth::user()->orderbytasksdesc->paginate(5);   
            }
            else if($by == '昇順'){
                 //   $by に昇順が入ればasc
                 $tasks = Auth::user()->orderbytasksasc->paginate(5);   
            }
            else{
                 //   入ってなければ全件取得
                 $tasks=Auth::user()->tasks->paginate(5);   
            }
        }
       return view('user.tasks.index', ['tasks' => $tasks, 'search_title' => $search_title]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('user/tasks');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        // taskをデータベースに保存
        $task = new Task;   
        $form = $request->except(["image", "_token"]);
        $task->fill($form);
        $task->user_id = $request->user()->id;
        $task->save();
        $tasks = Task::orderBy('deadline', 'desc')->get();
        
        //画像の保存
        $files = $request->file('image');
        // dd($files);
        if (isset($files)) {    
            foreach($files as $file){
                $image = new Image;
                // $path = $file->store('public/image');
                // $image->name = basename($path);
                $path = Storage::disk('s3')->putFile('/', $file, 'public');
                $image->name = Storage::disk('s3')->url($path);
                // dd($file);
            	$image->task_id = $task->id;
                $image->save();
            }
        } else {
            $image = null;
            // dd($image);
        }
        return redirect('user/tasks/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //  詳細画面
    public function show(Request $request, $id)
    {
        // idの取得
        $task = Task::find($id);
        
        return view('user.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
        // データの取得
        $task = Task::find($request->id);
        
        return view('user.tasks.edit', ['task_form' => $task]);
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
        
        // データの取得
        $task = Task::find($request->id);
        // 送信されてきたフォームデータの格納
        $task_form = $request->all();
        unset($task_form['_token']);
        //データの上書き
        $task->fill($task_form);
        $task->save();
        // Todo編集時のメール送信
        $user = Auth::user();
        $user_email = Auth::user()->email;
        Mail::to($user_email)->send(new EditSent($user, $task));
        
        //画像の保存
        $files = $request->file('image');
        // dd($files);
        if (isset($files)) {    
            foreach($files as $file){
                $image = new Image;
                // $path = $file->store('public/image');
                // $image->name = basename($path);
                $path = Storage::disk('s3')->putFile('/', $file, 'public');
                $image->name = Storage::disk('s3')->url($path);
                // dd($file);
            	$image->task_id = $task->id;
                $image->save();
            }
        } else {
            $image = null;
            // dd($image);
        }
        return redirect('user/tasks/');
    }

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        // データの取得
        $task = Task::find($request->id);
        // 削除
        $task->delete();
        //戻る処理　
        return redirect('user/tasks');
    }
}