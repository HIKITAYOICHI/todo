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
                <div class="card-header">
                    <div class="card-title" style="font-size: 20px;">Todo詳細</div>
                </div>
                <div class="card-body">
                    
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20%">題名</th>
                                    <th width="40%">Todo</th>
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
                            <div class="card-body" style="line-height: 0.3;">
                                <h6>登録画像一覧</h6>
                                <div class="row">
                                @foreach($task->images as $task_image)
                                    <div class="col-md" >
                                        <img src="{{ $task_image->name }}" width="150" height="150">
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body" style="line-height: 0.3;">
                                <h6>コメント登録</h6>
                                @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                                @endif
                        　　　     <form action="{{ action('User\CommentController@store') }}" method="post">
                        　　　         <div class="form-group">
                        　　　             <div class="row">
                                            <div class="col-md-10" style="position: relative; top: -8px;">
                                                <label for="Comment"></label>
                                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="commentを入力して下さい" name="comment">
                                            </div>
                                            <div class="col-md-2">
                                            {{ csrf_field() }}
                                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                <input type="submit" class="btn btn-primary" value="登録">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>        
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-10 mx-auto">
            <div class="card mt-3">
                <div class="card-header">
                    <div class="card-title" style="font-size: 20px;">コメント一覧</div>
                </div>
                <div class="card-body">
                    
                        @foreach($task->comments->paginate(5) as $comment)
                        <div class = 'card'>
                            <div class= "card-body">
                                <p class="card-text">{{ $comment->comment }}</p>
                                <p class="card-text">登録日:{{$comment->created_at->format('Y/m/d')}}
                                    <a href="{{ action('User\CommentController@delete', ['id' => $comment->id]) }}">
                                        <input type="submit" class="btn btn-danger" value="削除">
                                    </a>
                                </p>
                            </div>    
                        </div>
                        @endforeach
                        {{ $task->comments->paginate(5)->render() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
