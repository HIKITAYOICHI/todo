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
        $sort = $request->sortby;
        $deadline = $request->deadline;
        
        //クエリビルダの宣言
        $query = Auth::user()->tasks();
        //もしユーザが検索窓に入力していたら
        if(isset($search_title)) {
          //$queryに検索条件を追加
            $query->where('title', $search_title);
        }
        //もしユーザが並び替えにチェックしていたら
        if(isset($sort)){
          //$queryに並び替え条件を追加
            $query->orderBy('created_at', $sort);
        }
        //もしユーザーが期限にチェックしたら
        if(isset($deadline)) {
            //$queryに並び替え条件追加
            $query->orderByRaw('deadline IS NULL ASC')->orderBy('deadline');
        }
        //組み立てたクエリをもとにページネーションで値を取得
        $tasks = $query->paginate(5); 
                
        
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
        $task_form = $request->all();
        unset($task_form['_token']);
        $form = $request->except(["image", "_token"]);
        $task->fill($form);
        $task->user_id = $request->user()->id;
        $task->save();
        $tasks = Task::orderBy('deadline', 'desc')->get();
        
        // 画像の保存
        for ($i=0;$i<=2;$i++) {
            
            $image = $request->file('image' . $i);
            
            if (isset($image)) {
            
                $image = new Image;
                $path = Storage::disk('s3')->putFile('/', $task_form['image' . $i], 'public');
                $image->name = Storage::disk('s3')->url($path);
                $image->task_id = $task->id;
                $image->save();
            } 
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
            }
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