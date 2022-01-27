<!DOCTYPE html>
@extends('layouts.user.app')
{{-- app.blade.phpの@yield('title')に'埋めこみ --}}
@section('title', 'task management')
{{-- app.blade.phpの@yield('content')に以下のタグを埋め込む --}}
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Comment</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mx-auto">
                        @if (count($errors) > 0)
                            <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        @endif
                        <form action="{{ route('user.tasks.comment.store') }}" method="post">
                            {{ csrf_field() }}
                                
                            <div class="form-group">
                                <label for="Comment">Comment</label>
                                <input type="text" class="form-control" id="formGroupExampleInput" placeholder="commentを登録して下さい" name="comment">
                            </div>
                            {{ csrf_field() }}
                            <div class="text-right">
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                <input type="submit" class="btn btn-primary" value="コメント">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
