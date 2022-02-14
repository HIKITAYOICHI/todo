<!DOCTYPE html>
@extends('layouts.admin.admin')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mt-3">
                <div class="card-header" style="height: 40px;">
                    <div class="card-title" style="font-size: 20px; position: relative; top: -5px;">Task編集</div>
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
                            <label for="title" class="col-md-2 col-form-label">Task名編集</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="" name="title" value="{{ old('title', $task_form->title) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="body" class="col-md-2 col-form-label">詳細編集</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="body" value="{{ old('body', $task_form->body) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="deadline" class="col-md-2 col-form-label d-flex align-items-center">期限入力</label>
                            <div class="col-md-8 d-flex align-items-center">
                                <input type="date" name="deadline">
                            </div>
                        </div>
                        <div class="form-group">
                            @for ($i=0;$i<=2;$i++)
                                @if (isset($task_form->images[$i]->name))
                                <div class="row">
                                    <label for="name" class="col-md-2 col-form-label d-flex align-items-center">画像編集</label>
                                    <div class="col-md-7 d-flex align-items-center">
                                        <input type="file"name="image0" accept=".png, .jpg, .jpeg, .pdf, .doc" value="{{ old('name') }}">
                                        <input type="hidden" name='stored_image0' value="{{ $task_form->images[$i]->name }}">
                                    </div> 
                                    <div class="col-md-3 mt-2 d-flex justify-content-end align-items-center">
                                        <img src="{{ $task_form->images[$i]->name }}" width="70" height="70">
                                    </div>
                                </div>
                                @else
                                <div class="row">
                                    <label for="name" class="col-md-2 col-form-label d-flex align-items-center">画像登録</label>
                                    <div class="col-md-7 d-flex align-items-center">
                                        <input type="file"name="image0" accept=".png, .jpg, .jpeg, .pdf, .doc" value="{{ old('name') }}">
                                    </div> 
                                    <div class="col-md-3 mt-2 d-flex justify-content-end align-items-center">
                                        <img src="https://techboost-todo.s3.ap-northeast-1.amazonaws.com/uizmvX6zLA1BoNmFsWzrfTwwJLSI2m2CrbpwrsyH.png" alt="no_image" width="70" height="70">
                                    </div>
                                </div>
                                @endif
                            @endfor
                        </div>
                        <!--下記status_nameの送信-->
                        <div class="form-group row">
                            <label for="status_name"  class="col-md-2 col-form-label">進捗</label>
                            <div class="col-md-8 d-flex align-items-center">
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