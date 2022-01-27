<!DOCTYPE html>
<p>{{ $user->name }}様のTodoが編集されました<br>
【題名】<br>
{{ $task->title }}<br>
【Todo】<br>
{{ $task->body }}<br>
【期限】<br>
{{ $task->deadline }}</p>
