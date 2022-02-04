<!DOCTYPE html>
@extends('layouts.user.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="card-body">
        <h class= "card-title">Todo詳細</h>
        <div class="card">
            <div class="col-md-11 mx-auto">
                <table class="table table-reflow" style="position: relative; bottom: -15px;">
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
            </div>
            
            <div class="col-md-4">
                <h class= "card-title">画像</h>
            </div>
            @foreach($task->images as $task_image)
            <!--@php-->
            <!--  dump($task_image);-->
            <!--@endphp-->
                <div class="col-md-4">
                    <img src="{{ asset('storage/image/'. $task_image->name) }}" width="100" height="100">
                </div>
                
            @endforeach
            
        </div>

    <div class="card-body">
        <h class= "card-title">コメント投稿</h>
        <div class="card">
           <div class="col-md-11 mx-auto">
                @if (count($errors) > 0)
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                    @endif
            　　　　　   <form action="{{ action('User\CommentController@store') }}" method="post">
                        <div class="form-group">
                            <label for="Comment"></label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="commentを入力して下さい" name="comment">
                        </div>
                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <input type="hidden" name="task_id" value="{{ $task->id }}">
                            <input type="submit" class="btn btn-primary" value="投稿" style="position: relative; top: -10px;">
                        </div>
                    </form>
            </div>
        </div>    
    </div>

    <div class= "p-3">
        <h class= "card-title">コメント一覧</h>
            @foreach($task->comments->paginate(10) as $comment)
            <div class = 'card'>
                <div class= "card-body">
                    <p class="card-text">{{ $comment->comment }}</p>
                    <p class="card-text">投稿者:<a href="{{ action('User\TaskController@add') }}">{{ $comment->user->name }}</a></p>
                    <p class="card-text">投稿日:{{$comment->created_at->format('Y/m/d')}}
                        <a href="{{ action('User\CommentController@delete', ['id' => $comment->id]) }}">
                            <input type="submit" class="btn btn-danger" value="削除">
                        </a>
                    </p>
                </div>    
            </div>
            @endforeach
            {{ $task->comments->paginate(10)->render() }}
    </div>
</div>
@endsection
