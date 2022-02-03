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
                    <h2>Todoリスト編集</h2>
                    <form action="{{ action('User\TaskController@update') }}" method="post" enctype="multipart/form-data">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group">
                            <label class="formGroupExampleInput"for="title">題名</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="題名を入力して下さい" name="title" value="{{ old('title', $task_form->title) }}">
                        </div>
                        <div class="form-group">
                            <label class="formGroupExampleInput2"for="body">Todo</label>
                            <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="todoを入力して下さい" name="body" value="{{ old('body', $task_form->body) }}">
                        </div>
                        <!--画像投稿フォーム-->
                        <div class="form-group">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">画像</label>
                                <input class="form-control" type="file" id="formFile" name="image" value="{{ old('image') }}">
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <!--下記deadlineの送信-->
                        <div class="form-group">
                            <div class="text-right">
                                <label for="deadline">期限変更<lavel>
                                <input type="date" name="deadline" value="{{ old('deadline', $task_form->deadline) }}">
                            </div>
                        </div>
                        <!--下記status_nameの送信-->
                        <div class="form-group">
                            <div class="text-right">
                                <label for="status_name">進捗状態</label>
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
@endsection