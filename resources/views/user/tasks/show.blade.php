<!DOCTYPE html>
@extends('layouts.user.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h2>Task管理ツール-詳細画面</h2>
            <div class="card">
                <div class="card-header" style="height: 40px;">
                    <div class="card-title" style="font-size: 20px; position: relative; top: -5px;">Task詳細</div>
                </div>
                <div class="card-body" style="padding: 1rem;">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th width="20%">タイトル</th>
                                <th width="40%">Task</th>
                                <th width="15%">登録日</th>
                                <th width="15%">期限</th>
                                <th width="10%">進捗</th>
                            </tr>
                            <tbody>
                            <tr>
                                <td>{{ \Str::limit($task->title, 100) }}</td>
                                <td>{{ \Str::limit($task->body, 100) }}</td>
                                <!--下記登録日のフォーマット-->
                                <td>{{$task->created_at->format('Y/m/d')}}</td>
                                <td>{{$task->deadline}}</td>
                                <td>{{ \Str::limit($task->status_name, 50) }}</td>
                            </tr>
                            </tbody>
                        </thead>
                    </table>
                    <div class="card mt-3">
                        <div class="card-header" style="height: 20px;">
                            <div class="card-title" style="font-size: 15px; position: relative; top: -10px;">登録画像一覧</div>
                        </div>
                        <div class="card-body">
                            <h6></h6>
                            <div class="row"CD>
                            @foreach($task->images as $task_image)
                                <div class="col-md-3 d-flex justify-content-center align-items-center" >
                                   <img src="{{ $task_image->name }}" width="100" height="100"> 
                                </div>
                            @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mt-3">
                <div class="card-header" style="height: 40px;">
                    <div class="card-title" style="font-size: 20px; position: relative; top: -5px;">コメント一覧</div>
                </div>
                <div class="card-body" style="padding: 1rem;">
                   <form action="{{ action('User\CommentController@store') }}" method="post">
            　　　         @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="form-group row">
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="コメントを入力して下さい" name="comment">
                            </div>
                            <div class="col-md-2 text-right">
                            {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <input type="submit" class="btn btn-primary" value="登録">
                            </div>
                        </div>
                    </form>
                    @foreach($task->comments->paginate(5) as $comment)
                    <div class = 'card'>
                        <div class= "card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <p class="card-text">{{ $comment->comment }}</p>
                                </div>
                                <div class="col-md-3">
                                    <p class="card-text">登録日:{{$comment->created_at->format('Y/m/d')}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ action('User\CommentController@delete', ['id' => $comment->id]) }}">コメント削除</a>
                    </div>
                    @endforeach
                    {{ $task->comments->paginate(5)->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
