<!DOCTYPE html>
@extends('layouts.admin.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h2>Task管理ツール-詳細画面(Admin)</h2>
            <div class="card">
                <div class="card-header" style="height: 40px;">
                    <div class="card-title" style="font-size: 20px; position: relative; top: -5px;">Task詳細</div>
                </div>
                <div class="card-body" style="padding: 1rem;">
                    <table class="table table-bordered mt-1">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">ID</th>
                                <th width="5%">名前</th>
                                <th width="20%">タイトル</th>
                                <th width="30%">Task</th>
                                <th width="15%">登録日</th>
                                <th width="15%">期限</th>
                                <th width="15%">進捗</th>
                            </tr>
                            <tbody>
                            <tr>
                                <td>{{$task->user_id}}</td>
                                <td>{{$task->user->name}}</td>
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
                        <div class="card-body">
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
                        <a href="{{ action('Admin\CommentController@delete', ['id' => $comment->id]) }}">コメント削除</a>
                    </div>
                    @endforeach
                    {{ $task->comments->paginate(5)->render() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
