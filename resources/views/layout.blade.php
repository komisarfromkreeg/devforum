<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'DevForum')</title>
    <meta name="description" content="@yield('desc', 'Учебный проект на Laravel')">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">

<!-- HEADER -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">DevForum</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Главная</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('posts*') ? 'active' : '' }}" href="/posts">Темы</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Контакты</a>
                </li>

                @auth
                    @if(auth()->user()->email === 'admin@admin.com')
                        <li class="nav-item ms-3">
                            <a class="btn btn-outline-light btn-sm" href="/admin">Админка</a>
                        </li>
                    @endif

                    <li class="nav-item ms-3">
                        <a class="btn btn-success btn-sm" href="/posts/create">+ Создать тему</a>
                    </li>

                    <li class="nav-item ms-3">
                        <span class="text-light small">{{ auth()->user()->name }}</span>
                    </li>

                    <li class="nav-item ms-2">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Выход</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item ms-3">
                        <a class="btn btn-outline-light btn-sm" href="/login">Войти</a>
                    </li>

                    <li class="nav-item ms-2">
                        <a class="btn btn-success btn-sm" href="/register">Регистрация</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- MAIN -->
<main class="flex-grow-1">
    <div class="container mt-4">
        <div class="row">

            <!-- SIDEBAR -->
            <aside class="col-md-3 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">Навигация</h5>

                        <div class="list-group list-group-flush">
                            <a href="/"
                               class="list-group-item list-group-item-action {{ request()->is('/') ? 'active' : '' }}">
                                🏠 Главная
                            </a>

                            <a href="/posts"
                               class="list-group-item list-group-item-action {{ request()->is('posts*') ? 'active' : '' }}">
                                📚 Все темы
                            </a>

                            <a href="/contact"
                               class="list-group-item list-group-item-action {{ request()->is('contact') ? 'active' : '' }}">
                                ✉ Обратная связь
                            </a>

                            @auth
                                @if(auth()->user()->email === 'admin@admin.com')
                                    <a href="/admin"
                                       class="list-group-item list-group-item-action {{ request()->is('admin*') ? 'active' : '' }}">
                                        🛡 Админ-панель
                                    </a>
                                @endif
                            @endauth
                        </div>

                        <hr>

                        <h6 class="fw-bold">О проекте</h6>
                        <p class="small text-muted mb-0">
                            Учебный проект на Laravel.
                            Реализованы CRUD, поиск, авторизация и комментарии.
                        </p>

                    </div>
                </div>
            </aside>

            <!-- CONTENT -->
            <section class="col-md-9">

                @if (session('ok'))
                    <div class="alert alert-success">{{ session('ok') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')

            </section>

        </div>
    </div>
</main>

<!-- FOOTER -->
<footer class="bg-dark text-light mt-auto pt-4 pb-3 border-top border-secondary">
    <div class="container">
        <div class="row gy-4">

            <div class="col-md-4">
                <div class="fw-bold fs-5 mb-2">DevForum</div>
                <p class="small text-white-50 mb-2">
                    Учебный форум на Laravel: темы, комментарии, поиск и модерация.
                </p>
                <div class="small text-white-50">
                    Версия проекта: v1.0 • MVC • Bootstrap 5
                </div>
            </div>

            <div class="col-md-4">
                <div class="fw-bold mb-2">Навигация</div>
                <ul class="list-unstyled small mb-0">
                    <li class="mb-1"><a class="text-decoration-none text-white-50" href="/">Главная</a></li>
                    <li class="mb-1"><a class="text-decoration-none text-white-50" href="/posts">Темы</a></li>
                    <li class="mb-1"><a class="text-decoration-none text-white-50" href="/contact">Контакты</a></li>

                    @auth
                        @if(auth()->user()->email === 'admin@admin.com')
                            <li class="mb-1"><a class="text-decoration-none text-white-50" href="/admin">Админ-панель</a></li>
                        @endif
                    @endauth
                </ul>
            </div>

            <div class="col-md-4">
                <div class="fw-bold mb-2">Аккаунт</div>

                @auth
                    <div class="small text-white-50 mb-2">
                        Вы вошли как: <span class="text-light">{{ auth()->user()->name }}</span>
                    </div>
                    <a class="btn btn-success btn-sm mb-2" href="/posts/create">+ Создать тему</a>

                    <div>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">Выход</button>
                        </form>
                    </div>
                @else
                    <div class="d-flex gap-2">
                        <a class="btn btn-outline-light btn-sm" href="/login">Войти</a>
                        <a class="btn btn-success btn-sm" href="/register">Регистрация</a>
                    </div>

                    <div class="small text-white-50 mt-2">
                        Хотите написать тему? Сначала войдите в аккаунт.
                    </div>
                @endauth
            </div>

        </div>

        <hr class="my-4">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <div class="small text-white-50">
                © {{ date('Y') }} DevForum • Учебный проект
            </div>
            <div class="small">
                <a class="text-decoration-none text-white-50 me-3" href="/contact">Обратная связь</a>
                <span class="text-white-50">Сделано на Laravel</span>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/app.js"></script>

</body>
</html>
