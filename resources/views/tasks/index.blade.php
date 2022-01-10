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
                         <input type="text" class="form-control" id="formGroupExampleInput" placeholder="" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                         <label class="formGroupExampleInput2"for="body">Todo</label>
                         <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="body" value="{{ old('body') }}">
                    </div>
                    <!--下記のinputでデフォルト値を'未着'に変更-->
                   
                    <!--　調べておく　-->
                    {{ csrf_field() }}
                    <div class="text-right">
                        <input type="submit" class="btn btn-primary" value="追加">
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
                
                    
                        <thead>
                            <tr>
                                <th width="20%">題名</th>
                                <th width="40%">Todo</th>
                                <th width="10%">進捗</th>
                                <th width="10%"></th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!--絞り込み２段階-->
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ \Str::limit($task->title, 100) }}</td>
                                    <td>{{ \Str::limit($task->body, 250) }}</td>
                                    <!-- 下記<td>は進捗入れる場所　プルダウンで -->
                                    <td>
                                        <!--<select name="status_id">-->
                                        <!--    <option value=1>未着</option>-->
                                        <!--    <option value=2>未完了</option>-->
                                        <!--    <option value=3>完了</option>-->
                                        <!--</select>-->
                                        {{ \Str::limit($task->status_name, 50) }}
                                    </td>
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