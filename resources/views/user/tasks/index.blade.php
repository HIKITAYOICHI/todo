<!DOCTYPE html>
@extends('layouts.user.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h2>Todo管理アプリ</h2>
            <div class="card mt-3">
                <div class="card-header" style="line-height: 1;">
                    <div class="card-title" style="font-size: 20px;">リスト登録フォーム</div>
                </div>
                <div class="card-body">
                    <form action="{{ action('User\TaskController@store') }}" method="post" enctype="multipart/form-data">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                     <label class="formGroupExampleInput"for="title">題名</label>
                                     <input type="text" class="form-control" id="formGroupExampleInput" placeholder="題名を登録して下さい" name="title" value="{{ old('title') }}">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                     <label class="formGroupExampleInput2"for="body">Todo</label>
                                     <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Todoを登録して下さい" name="body" value="{{ old('body') }}">
                                </div>
                            </div>
                        </div>    
                        <label>画像投稿フォーム</label>
                        <div class="form-group">
                            <input type="file" id="image" name="image[]" accept=".png, .jpg, .jpeg, .pdf, .doc" multiple value="{{ old('name') }}">
                        </div>
                        {{ csrf_field() }}
                        <!--下記日付の登録フォーム-->
                        <div class="form-group text-right">
                                <label for="deadline">期限入力<lavel>
                                <input type="date" name="deadline">
                        </div>
                        <!--下記status_nameのデフォルト値の入力-->
                        <input type="hidden" name="status_name" value="未着">
                        <!--下記ボタンの右寄せ-->
                        {{ csrf_field() }}
                        <div class="text-right">
                            <input type="submit" class="btn btn-primary" value="登録">
                        </div>
                    </form>
                </div>
            </div>
        </div>    
    </div>
    <div class="row mt-3">
        <div class="col-md-10 mx-auto">
            <div class="card">
                <div class="card-header" style="line-height: 1;">
                    <div class="card-title" style="font-size: 20px;">リスト一覧</div>
                </div>
                <div class="card-body">
                        <div class="row" style="margin: 0px;">
                            <div class="col-md-2 px-0" style="bottom: -6px;">
                                <h5>検索フォーム</h5>
                            </div> 
                            <div class="col-md-4 px-0">
                                <div id="custom-search-input">
                                    <div class="input-group">
                                        <form action="{{ action('User\TaskController@index') }}" method="get">
                                            <input type="text" class="form-control input-lg" placeholder="" name="search_title" value="{{ $search_title }}">
                                            <span class="input-group-btn" style="position: relative;top: -37px;right: -210px;">
                                                {{ csrf_field() }}
                                                <button class="btn btn-info" type="submit" style="position: relative; right: 30px;">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h6>Todoリスト並び替え
                            <a href="{{ action('User\TaskController@index', ['sortby' => "降順"]) }}">降順</a>
                            <a href="{{ action('User\TaskController@index', ['sortby' => "昇順"]) }}">昇順</a>
                        </h6>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th width="20%">題名</th>
                                    <th width="40%">Todo</th>
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
                        {{ $tasks->links() }}
                </div>    
            </div>
        </div>
    </div>
</div>
@endsection