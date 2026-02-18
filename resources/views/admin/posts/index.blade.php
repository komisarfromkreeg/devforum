@extends('layout')

@section('title', 'Админ | Темы')
@section('desc', 'Управление темами')

@section('content')
<h1 class="mb-3">Панель модерации</h1>

<a class="btn btn-primary btn-sm mb-3" href="{{ route('admin.posts.create') }}">
    + Создать тему
</a>

@foreach ($posts as $post)
    <div class="card mb-3 p-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-start gap-2">
            <div>
                <h4 class="mb-1">
                    <a href="{{ route('posts.show', $post->slug) }}" class="text-decoration-none">
                        {{ $post->title }}
                    </a>
                </h4>

                <p class="text-muted small mb-0">
                    Создано: {{ $post->created_at->format('d.m.Y H:i') }}
                </p>
            </div>

            <div class="text-end">
                <a class="btn btn-warning btn-sm" href="{{ route('admin.posts.edit', $post) }}">
                    Редактировать
                </a>

                <form method="POST"
                      action="{{ route('admin.posts.destroy', $post) }}"
                      class="d-inline"
                      onsubmit="return confirm('Удалить тему?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">
                        Удалить
                    </button>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{ $posts->links() }}
@endsection
