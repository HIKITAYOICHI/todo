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
                         <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Example input" name="title" value="{{ old('title') }}">
                    </div>
                    <div class="form-group">
                         <label class="formGroupExampleInput2"for="body">Todo</label>
                         <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Another input" name="body" rows="1"{{ old('body') }}>
                    </div>
                    {{ csrf_field() }}
                    <div class="text-right">
                        <input type="submit" class="btn btn-primary" value="更新">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
