@extends('layout')

@section('title', 'Создать пост')
@section('desc', 'Создание поста')

@section('content')
<h1 class="mb-3">Создать пост</h1>

<form method="POST" action="{{ route('admin.posts.store') }}" class="card p-3">
    @csrf

    <label class="form-label">Заголовок</label>
    <input class="form-control mb-2" name="title" value="{{ old('title') }}">

    <label class="form-label">Текст</label>
    <textarea class="form-control mb-3" name="content" rows="8">{{ old('content') }}</textarea>

    <button class="btn btn-success">Сохранить</button>
</form>
@endsection
