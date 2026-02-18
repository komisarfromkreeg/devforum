@extends('layout')

@section('title', 'Создать тему | DevForum')
@section('desc', 'Создание новой темы')

@section('content')
<h1 class="mb-3">Создать тему</h1>

<div class="card shadow-sm">
    <div class="card-body">
        <form method="POST" action="{{ route('posts.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Заголовок</label>
                <input
                    type="text"
                    name="title"
                    class="form-control"
                    value="{{ old('title') }}"
                    required
                    minlength="5"
                    maxlength="255"
                    placeholder="Например: Как настроить Laravel на хостинге?"
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
                    placeholder="Опиши проблему или тему обсуждения..."
                >{{ old('content') }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success">Опубликовать</button>
                <a class="btn btn-outline-secondary" href="{{ route('posts.index') }}">Отмена</a>
            </div>
        </form>
    </div>
</div>
@endsection
