<!DOCTYPE html>
@extends('layouts.user.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Todo詳細</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-11 mx-auto">
                    <table class="table table-reflow">
                        <thead class="thead-light">
                            <tr>
                                <th width="20%">題名</th>
                                <th width="40%">Todo</th>
                                <th width="15%">登録日</th>
                                <th width="15%">期限</th>
                                <th width="10%">進捗</th>
                                <!--<th width="5%"></th>-->
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
                    <div class= "p-3">
                        <div class= "card">
                            <div class= "card-body">
                                <p class="card-text">{{ 'テストコメント' }}</p>
                            </div>    
                        </div>
                        <div class="text-right">
                            <a href="{{ route('user.tasks.comment', ['task_id' => $task->id]) }}" class="btn btn-primary btn-sm">コメント投稿</a>
                        </div>
                    </div>
                                
                </div>    
            </div>
        </div>
    </div>    
</div>
@endsection
