@extends('layout')

@section('title', 'Редактировать тему | DevForum')

@section('content')
<a href="{{ route('posts.show', $post->slug) }}" class="btn btn-outline-secondary btn-sm mb-3">← Назад</a>

<h1 class="mb-3">Редактировать тему</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('posts.update', $post->slug) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Заголовок</label>
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="{{ old('title', $post->title) }}"
                    required
                    minlength="5"
                    maxlength="255"
                >
            </div>

            <div class="mb-3">
                <label class="form-label">Текст темы</label>
                <textarea
                    name="content"
                    class="form-control"
                    rows="7"
                    required
                    minlength="10"
                >{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-warning">Сохранить</button>
                <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-outline-secondary">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection
