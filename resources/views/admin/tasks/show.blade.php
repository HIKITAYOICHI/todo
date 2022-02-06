<!DOCTYPE html>
@extends('layouts.admin.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="card-body">
        <h class= "card-title">Todo詳細</h>
        <div class="card">
            <div class="col-md-11 mx-auto">
                <table class="table table-bordered" style="position: relative; bottom: -15px;">
                    <thead class="thead-light">
                        <tr>
                            <th width="15%">ユーザー</th>
                            <th width="15%">題名</th>
                            <th width="30%">Todo</th>
                            <th width="15%">登録日</th>
                            <th width="15%">期限</th>
                            <th width="15%">進捗</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td>{{ \Str::limit($task->user->name, 100) }}</td>
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
            <h class= "card-title">画像</h>
            <img src="{{ asset('storage/image/'. $task->image) }}" width="100" height="100">
        </div>
    </div>
    
    <div class= "p-3">
    <h class= "card-title">コメント一覧</h>
        @foreach($task->comments->paginate(7) as $comment)
        <div class = 'card'>
            <div class= "card-body">
                <p class="card-text">{{ $comment->comment }}</p>
                <p class="card-text">投稿者:<a href="{{ action('Admin\TaskController@add') }}">{{ $comment->user->name }}</a></p>
                <p class="card-text">投稿日:{{$comment->created_at->format('Y/m/d')}}
                    <a href="{{ action('Admin\CommentController@delete', ['id' => $comment->id]) }}">
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
