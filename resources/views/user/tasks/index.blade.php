<!DOCTYPE html>
@extends('layouts.user.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <h2>Todoリスト登録</h2>
                    <form action="{{ action('User\TaskController@store') }}" method="post" enctype="multipart/form-data">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group">
                             <label class="formGroupExampleInput"for="title">題名</label>
                             <input type="text" class="form-control" id="formGroupExampleInput" placeholder="題名を登録して下さい" name="title" value="{{ old('title') }}">
                        </div>
                        <div class="form-group">
                             <label class="formGroupExampleInput2"for="body">Todo</label>
                             <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Todoを登録して下さい" name="body" value="{{ old('body') }}">
                        </div>
                        <!--下記日付の登録フォーム-->
                        <div class="form-group">
                            <div class="text-right">
                                <label for="deadline">期限入力<lavel>
                                <input type="date" name="deadline">
                            </div>
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
    <div class="card" style="position: relative; bottom: -5px;">
        <div class="card-body">
        	<div class="row">
                <div class="col-md-6">
                    <h5 class="card-title" style="position: relative; right: -45px;">検索フォーム</h2>
                    <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <form action="{{ action('User\TaskController@index') }}" method="get">
                                <input type="text" class="form-control input-lg" style="position: relative; right: -30px;" placeholder="" name="search_title" value="{{ $search_title }}">
                                <span class="input-group-btn" style="position: relative;top: -37px;right: -190px;">
                                    {{ csrf_field() }}
                                    <button class="btn btn-info" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </span>
                            </form>
                        </div>
                    </div>
                </div>
            	<div style="position: relative; right: -280px; bottom: -110px;">
                    <label>Todoリスト並び替え</lavel>
                    <a href="{{ action('User\TaskController@index', ['sortby' => "降順"]) }}">降順</a>
                    <a href="{{ action('User\TaskController@index', ['sortby' => "昇順"]) }}">昇順</a>
                </div>
            </div>
            
            <div class="row" style="position: relative;top: -20px;">
                <div class="col-md-11 mx-auto">
                    <table class="table table-reflow">
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
                        {{ $tasks->links() }}
                        </tbody>
                    </table>
                </div>    
            </div>
        </div>
    </div>
</div>        
@endsection