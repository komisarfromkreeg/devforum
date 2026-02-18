@extends('layout')

@section('title', 'Редактировать пост')
@section('desc', 'Редактирование поста')

@section('content')
<h1 class="mb-3">Редактировать пост</h1>

<form method="POST" action="{{ route('admin.posts.update', $post) }}" class="card p-3">
    @csrf
    @method('PUT')

    <label class="form-label">Заголовок</label>
    <input class="form-control mb-2" name="title" value="{{ old('title', $post->title) }}">

    <label class="form-label">Текст</label>
    <textarea class="form-control mb-3" name="content" rows="8">{{ old('content', $post->content) }}</textarea>

    <button class="btn btn-success">Обновить</button>
</form>
@endsection
