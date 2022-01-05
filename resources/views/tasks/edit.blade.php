<!DOCTYPE html>
@extends('layouts.layout')
{{-- layout.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- layout.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<!--　編集時ここに飛べるように-->
<div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>リスト編集</h2>
                <form action="{{ action('TaskController@update') }}" method="post" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group">
                         <label class="formGroupExampleInput"for="title">題名</label>
                         <input type="text" class="form-control" id="formGroupExampleInput" placeholder="" name="title" value="{{ old('title', $task_form->title) }}">
                    </div>
                    <div class="form-group">
                         <label class="formGroupExampleInput2"for="body">Todo</label>
                         <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="body" value="{{ old('body', $task_form->body) }}">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                              <label class="formGroupExampleInput2"for="status_name">進捗</label>
                              <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="" name="status_name" value="{{ old('status_name', $task_form->status_name) }}">
                            </div>
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
@endsection
