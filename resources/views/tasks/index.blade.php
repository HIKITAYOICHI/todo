<!DOCTYPE html>
@extends('layouts.layout')
{{-- layout.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- layout.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>Todoリスト登録</h2>
                <form action="{{ action('TaskController@store') }}" method="post" enctype="multipart/form-data">
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
        <div class="row">
            <div class="col-md-9 mx-auto">
                <div class="col-md-8">
                    <h2>リスト一覧</h2>
                </div>
                <div class="col-md-4">
                    <form action="{{ action('TaskController@index') }}" method="get">
                        <div class="form-group row ">
                            <label class="col-md-3">題名</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="search_title" value="{{ $search_title }}">
                            </div>
                            <div class="col-md-2">
                            {{ csrf_field() }}
                                <input type="submit" class="btn btn-primary" value="検索">
                            </div>
                        </div>
                    </form>
               </div>
           </div>
        </div> 
        
        <div class="row">
            <div class="col-md-9 mx-auto">
                <table class="table table-reflow">
                    <thead class="thead-light">
                        <tr>
                            <th width="20%">題名</th>
                            <th width="40%">Todo</th>
                            <th width="20%">期限</th>
                            <th width="10%">進捗</th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                <tbody>
                    <!--絞り込み２段階-->
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ \Str::limit($task->title, 100) }}</td>
                            <td>{{ \Str::limit($task->body, 100) }}</td>
                            <td>
                                <!--日付持ってくる-->
                                <!--<input type="date">-->
                                {{$task->deadline}}
                            </td>
                            <td>{{ \Str::limit($task->status_name, 50) }}</td>
                            <td>
                                <div>
                                    <a href="{{ action('TaskController@edit', ['id' => $task->id]) }}">
                                    <input type="submit" class="btn btn-primary" value="編集">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div>
                                    <a href="{{ action('TaskController@delete', ['id' => $task->id]) }}">
                                    <input type="submit" class="btn btn-danger" value="削除">
                                    </a>
                                </div>
                            </td>
                        </tr>
                            @endforeach
                </tbody>
                </table>
            </div>    
        </div>
    </div>
    @endsection