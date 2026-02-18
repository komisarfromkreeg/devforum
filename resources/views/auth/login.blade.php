@extends('layout')

@section('title', 'Вход')
@section('desc', 'Вход в аккаунт')

@section('content')
<h1 class="mb-3">Вход</h1>

<form method="POST" action="{{ route('login') }}" class="card p-3">
    @csrf

    <label class="form-label">Email</label>
    <input class="form-control mb-2" name="email" value="{{ old('email') }}">

    <label class="form-label">Пароль</label>
    <input class="form-control mb-3" type="password" name="password">

    <button class="btn btn-primary">Войти</button>
</form>
@endsection
