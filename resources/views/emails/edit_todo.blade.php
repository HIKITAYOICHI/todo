<!DOCTYPE html>
<p>{{ $user->name }}様のTaskが編集されました<br>
【Task名】<br>
{{ $task->title }}<br>
【詳細】<br>
{{ $task->body }}<br>
【期限】<br>
{{ $task->deadline }}</p>
