@extends('layout')

@section('title', 'Темы | DevForum')
@section('desc', 'Список тем и поиск')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-0">Темы форума</h1>

    @auth
        <a class="btn btn-success btn-sm" href="{{ route('posts.create') }}">+ Создать тему</a>
    @endauth
</div>

<form class="row g-2 mb-3" method="GET" action="{{ route('posts.index') }}">
    <div class="col-sm-8">
        <input class="form-control" name="q" value="{{ $q }}" placeholder="Поиск по заголовку/тексту">
    </div>
    <div class="col-sm-4">
        <button class="btn btn-dark w-100">Искать</button>
    </div>
</form>

@if($posts->count() === 0)
    <div class="alert alert-warning">Ничего не найдено</div>
@endif

@foreach ($posts as $post)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <h3 class="h5 mb-1">
                <a class="text-decoration-none" href="{{ route('posts.show', $post->slug) }}">
                    {{ $post->title }}
                </a>
            </h3>

            <div class="text-muted small mb-2">
                Автор: {{ $post->user->name ?? '—' }} • {{ $post->created_at->format('d.m.Y H:i') }}
            </div>

            <div class="text-body">
                {{ \Illuminate\Support\Str::limit($post->content, 160) }}
            </div>
        </div>
    </div>
@endforeach

<div class="mt-3">
    {{ $posts->links() }}
</div>
@endsection
