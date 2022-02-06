<!DOCTYPE html>
@extends('layouts.user.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <h2>Task管理ツール-編集画面(Admin)</h2>
            <div class="card mt-3">
                <div class="card-header" style="height: 40px;">
                    <div class="card-title" style="font-size: 20px; position: relative; top: -5px;">リスト編集</div>
                </div>
                <div class="card-body">
                    <form action="{{ action('Admin\TaskController@update') }}" method="post" enctype="multipart/form-data">
                        @if (count($errors) > 0)
                            <ul>
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <div class="form-group row">
                            <label for="title" class="col-md-2 col-form-label">タイトル編集</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="" name="title" value="{{ old('title', $task_form->title) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-2 col-form-label">Task編集</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="body" value="{{ old('body', $task_form->body) }}">
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
                                <input type="file" id="image" name="image[]" accept=".png, .jpg, .jpeg, .pdf, .doc" multiple value="{{ old('name') }}">
                            </div>
                        </div>
                        <!--下記status_nameの送信-->
                        <div class="form-group row">
                            <label for="status_name"  class="col-md-2 col-form-label">進捗</label>
                            <div class="col-md-8">
                                <select name="status_name">
                                    <option value="未着">未着</option>
                                    <option value="未完了">未完了</option>
                                    <option value="完了">完了</option>
                                </select>
                            </div>
                            {{ csrf_field() }}
                            <div class="col-md-2 text-right">
                                <input type="hidden" name="id" value="{{ $task_form->id }}">
                                <input type="submit" class="btn btn-primary" value="更新">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>
@endsection