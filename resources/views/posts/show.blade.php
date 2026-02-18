@extends('layout')

@section('title', $post->title)

@section('content')

<a href="{{ route('posts.index') }}" class="btn btn-outline-secondary btn-sm mb-3">← Назад</a>

@auth
    @if($post->user_id === auth()->id())
        <form method="POST"
              action="{{ route('posts.destroy', $post->slug) }}"
              class="d-inline"
              onsubmit="return confirm('Удалить тему?')">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm mb-3">Удалить тему</button>
        </form>
    @endif
@endauth

@auth
    @if($post->user_id === auth()->id())
        <a class="btn btn-warning btn-sm mb-3" href="{{ route('posts.edit', $post->slug) }}">
            Редактировать
        </a>
    @endif
@endauth


<h1 class="mb-3">{{ $post->title }}</h1>

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <div class="text-muted small mb-2">
            Автор: {{ $post->user->name ?? '—' }} • {{ $post->created_at->format('d.m.Y H:i') }}
        </div>
        <div>{{ $post->content }}</div>
    </div>
</div>

<h4 class="mb-3">Комментарии</h4>

@auth
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="mb-3">
                    <label class="form-label">Добавить комментарий</label>
                    <textarea class="form-control" name="content" rows="3" required></textarea>
                </div>

                <button class="btn btn-primary btn-sm">Отправить</button>
            </form>
        </div>
    </div>
@else
    <div class="alert alert-info">
        Чтобы написать комментарий — <a href="/login">войдите</a> или <a href="/register">зарегистрируйтесь</a>.
    </div>
@endauth

@forelse($post->comments as $comment)
    <div class="card mb-2">
        <div class="card-body py-2">
            <div class="small text-muted mb-1">
                {{ $comment->user->name ?? '—' }} • {{ $comment->created_at->format('d.m.Y H:i') }}
            </div>
            <div>{{ $comment->content }}</div>
        </div>
    </div>
@empty
    <div class="text-muted">Комментариев пока нет.</div>
@endforelse

@endsection
