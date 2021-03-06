<!DOCTYPE html>
@extends('layouts.user.user')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header" style="height: 40px;">
                    <div class="card-title" style="font-size: 20px; position: relative; top: -5px;">Task一覧</div>
                </div>
                <div class="card-body" style="padding: 1rem;">
                    <div class="row">
                        <div class="col-md-9 align-self-end">
                            各種ソート:
                            <a href="{{ action('User\TaskController@index', ['sortby' => "desc"]) }}">降順 </a>
                            <a href="{{ action('User\TaskController@index', ['sortby' => "asc"]) }}">昇順 </a>
                            <a href="{{ action('User\TaskController@index', ['deadline' => "asc"]) }}">期限 </a>
                            
                        </div>
                        <div class="col-md-3">
                            <form action="{{ action('User\TaskController@index') }}" method="get">
                                <div class="input-group">
                                    <input type="text" class="form-control input-lg" placeholder="Task名の検索" name="search_title" value="{{ $search_title }}">
                                    <span class="input-group-btn">
                                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                                    </span>
                                </div>
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </div>
                    <!--テーブルのレスポンシブ化-->
                    <div class="table-wrap">
                        <table class="table table-bordered mt-1">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20%">Task名</th>
                                    <th width="40%">詳細</th>
                                    <th width="15%">登録日</th>
                                    <th width="15%">期限</th>
                                    <th width="10%">進捗</th>
                                    <th width="5%"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ \Str::limit($task->title, 100) }}</td>
                                    <td>{{ \Str::limit($task->body, 100) }}</td>
                                    <!--下記登録日のフォーマット-->
                                    <td>{{$task->created_at->format('Y/m/d')}}</td>
                                    <td>{{$task->deadline}}</td>
                                    <td>{{ \Str::limit($task->status_name, 50) }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                            <a href="{{ action('User\TaskController@show', ['id' => $task->id]) }}"><input type="submit" class="btn btn-primary btn-sm" value="詳細"></a>
                                            <a href="{{ action('User\TaskController@edit', ['id' => $task->id]) }}"><input type="submit" class="btn btn-success btn-sm" value="編集"></a>
                                            <a href="{{ action('User\TaskController@delete', ['id' => $task->id]) }}"><input type="submit" class="btn btn-danger btn-sm" value="削除"></a>
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
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mt-3">
                <div class="card-header" style="height: 40px;">
                    <div class="card-title" style="font-size: 20px; position: relative; top: -5px;">Taskの追加</div>
                </div>
                <div class="card-body" style="padding: 1.0rem;">
                    <form action="{{ action('User\TaskController@store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                        @endif
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label">Task名</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="" name="title" value="{{ old('title') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-2 col-form-label">詳細</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="body" value="{{ old('body') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deadline" class="col-md-2 col-form-label">期限入力</label>
                            <div class="col-md-8">
                                <input type="date" name="deadline">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label">画像登録</label>
                            <div class="col-md-8">
                                <input type="file"  name="image0" accept=".png, .jpg, .jpeg, .pdf, .doc" value="{{ old('name') }}">
                                <input type="file"  name="image1" accept=".png, .jpg, .jpeg, .pdf, .doc" value="{{ old('name') }}">
                                <input type="file"  name="image2" accept=".png, .jpg, .jpeg, .pdf, .doc" value="{{ old('name') }}">
                            </div>
                            <div class="col-md-2 text-right">
                                <input type="submit" class="btn btn-primary" value="登録">
                            </div>
                        </div>
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection