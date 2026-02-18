@extends('layout')

@section('title', 'Регистрация')
@section('desc', 'Регистрация пользователя')

@section('content')
<h1 class="mb-3">Регистрация</h1>

<form method="POST" action="{{ route('register') }}" class="card p-3">
    @csrf

    <label class="form-label">Имя</label>
    <input class="form-control mb-2" name="name" value="{{ old('name') }}">

    <label class="form-label">Email</label>
    <input class="form-control mb-2" name="email" value="{{ old('email') }}">

    <label class="form-label">Пароль</label>
    <input class="form-control mb-2" type="password" name="password">

    <label class="form-label">Повтор пароля</label>
    <input class="form-control mb-3" type="password" name="password_confirmation">

    <button class="btn btn-success">Создать аккаунт</button>
</form>
@endsection
