@extends('layout')

@section('title', 'DevForum — сообщество разработчиков')
@section('desc', 'Обсуждение программирования, веб-разработки и технологий')

@section('content')

<!-- HERO -->
<div class="p-4 p-md-5 mb-4 bg-dark text-white rounded-3 shadow-sm">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h1 class="display-6 fw-bold mb-2">DevForum</h1>
            <p class="lead mb-3">
                Платформа для обсуждения программирования, веб-разработки и современных технологий.
                Создавайте темы, задавайте вопросы и делитесь опытом.
            </p>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('posts.index') }}" class="btn btn-success">
                    Смотреть темы
                </a>

                @auth
                    <a href="{{ route('posts.create') }}" class="btn btn-outline-light">
                        + Создать тему
                    </a>
                @else
                    <a href="/register" class="btn btn-outline-light">
                        Регистрация
                    </a>
                @endauth
            </div>
        </div>

        <div class="col-lg-4 d-none d-lg-block">
            <div class="bg-white bg-opacity-10 rounded-3 p-3">
                <div class="small text-white-50">Быстрый старт</div>
                <div class="mt-2">
                    ✅ Темы и комментарии<br>
                    ✅ Поиск<br>
                    ✅ Админ-модерация<br>
                    ✅ Форма обратной связи
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FEATURES -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold">🧩 Темы</h5>
                <p class="text-muted mb-0">Создавайте обсуждения и делитесь опытом с другими участниками.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold">💬 Комментарии</h5>
                <p class="text-muted mb-0">Обсуждайте решения, оставляйте советы и уточняйте детали.</p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <h5 class="fw-bold">🛡 Модерация</h5>
                <p class="text-muted mb-0">Админ может управлять темами и поддерживать порядок на форуме.</p>
            </div>
        </div>
    </div>
</div>

<!-- LATEST POSTS -->
<div class="d-flex justify-content-between align-items-center mb-2">
    <h2 class="h4 mb-0">Последние темы</h2>
    <a href="{{ route('posts.index') }}" class="small text-decoration-none">Все темы →</a>
</div>

@if($latestPosts->isEmpty())
    <div class="alert alert-warning">Пока нет тем. Создайте первую!</div>
@else
    <div class="list-group shadow-sm">
        @foreach($latestPosts as $post)
            <a class="list-group-item list-group-item-action"
               href="{{ route('posts.show', $post->slug) }}">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <div class="fw-bold">{{ $post->title }}</div>
                        <div class="small text-muted">
                            Автор: {{ $post->user->name ?? '—' }} • {{ $post->created_at->format('d.m.Y H:i') }}
                        </div>
                    </div>
                    <span class="badge text-bg-light">→</span>
                </div>
            </a>
        @endforeach
    </div>
@endif

@endsection
    