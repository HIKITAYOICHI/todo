<!DOCTYPE html>
@extends('layouts.admin.admin')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header" style="height: 40px;">
                    <div class="card-title" style="font-size: 20px; position: relative; top: -5px;">全ユーザーTask一覧</div>
                </div>
                <div class="card-body" style="padding: 1.0rem;">
                    <div class="row">
                        <div class="col-md-9 align-self-end">
                            各種ソート:
                            <a href="{{ action('Admin\TaskController@index', ['sortby' => "desc"]) }}">降順 </a>
                            <a href="{{ action('Admin\TaskController@index', ['sortby' => "asc"]) }}">昇順 </a>
                            <a href="{{ action('Admin\TaskController@index', ['deadline' => "asc"]) }}">期限 </a>
                        </div>
                        <div class="col-md-3">
                            <form action="{{ action('Admin\TaskController@index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" placeholder="Taskの検索" name="search_title" value="{{ $search_title }}">
                                    <span class="input-group-btn">
                                        {{ csrf_field() }}
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                        <!--テーブルのレスポンシブ化-->
                        <div class="table-wrap">
                            <table class="table table-bordered mt-1">
                                <thead class="thead-light">
                                    <tr>
                                        <th width="5%">ID</th>
                                        <th width="10%">User</th>
                                        <th width="20%">Task名</th>
                                        <th width="25%">詳細</th>
                                        <th width="15%">登録日</th>
                                        <th width="15%">期限</th>
                                        <th width="15%">進捗</th>
                                        <th width="5%"></th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{$task->user_id}}</td>
                                        <td>{{$task->user->name}}</td>
                                        <td>{{ \Str::limit($task->title, 100) }}</td>
                                        <td>{{ \Str::limit($task->body, 100) }}</td>
                                        <!--下記登録日のフォーマット-->
                                        <td>{{$task->created_at->format('Y/m/d')}}</td>
                                        <td>{{$task->deadline}}</td>
                                        <td>{{ \Str::limit($task->status_name, 50) }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                <a href="{{ action('Admin\TaskController@show', ['id' => $task->id]) }}"><input type="submit" class="btn btn-primary btn-sm" value="詳細"></a>
                                                <a href="{{ action('Admin\TaskController@edit', ['id' => $task->id]) }}"><input type="submit" class="btn btn-success btn-sm" value="編集"></a>
                                                <a href="{{ action('Admin\TaskController@delete', ['id' => $task->id]) }}"><input type="submit" class="btn btn-danger btn-sm" value="削除"></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>    
                    <!--ページネーション-->
                    <div class="d-flex justify-content-center">
                         {{ $tasks->links() }}
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection