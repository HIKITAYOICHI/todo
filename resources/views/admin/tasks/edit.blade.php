<!DOCTYPE html>
@extends('layouts.user.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 mx-auto">
            <h2>Task管理ツール-編集画面</h2>
            <div class="card mt-3">
                <div class="card-header">
                    <div class="card-title" style="font-size: 20px;">リスト編集</div>
                </div>
                <div class="card-body">
                    <div class= "p-3">
                        <form action="{{ action('Admin\TaskController@update') }}" method="post" enctype="multipart/form-data">
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="form-group">
                                <label class="formGroupExampleInput"for="title">題名編集</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="題名を入力して下さい" name="title" value="{{ old('title', $task_form->title) }}">
                            </div>
                            <div class="form-group">
                                <label class="formGroupExampleInput2"for="body">Todo編集</label>
                                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="todoを入力して下さい" name="body" value="{{ old('body', $task_form->body) }}">
                            </div>
                            <!--画像投稿フォーム-->
                            画像投稿フォーム
                            <div class="form-group">
                                <input type="file" id="image" name="image[]" accept=".png, .jpg, .jpeg, .pdf, .doc" multiple value="{{ old('name') }}">
                            </div>
                            {{ csrf_field() }}
                            <!--下記deadlineの送信-->
                            <div class="form-group">
                                <div class="text-right">
                                    <label for="deadline">期限編集<lavel>
                                    <input type="date" name="deadline" value="{{ old('deadline', $task_form->deadline) }}">
                                </div>
                            </div>
                            <!--下記status_nameの送信-->
                            <div class="form-group">
                                <div class="text-right">
                                    <label for="status_name">進捗</label>
                                    <select name="status_name">
                                        <option value="未着">未着</option>
                                        <option value="未完了">未完了</option>
                                        <option value="完了">完了</option>
                                    </select>
                                </div>
                            </div>
                                {{ csrf_field() }}
                            <div class="text-right">
                                <input type="hidden" name="id" value="{{ $task_form->id }}">
                                <input type="submit" class="btn btn-primary" value="更新">
                            </div>
                        </form>
                    </div>    
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection