@extends('layout')

@section('title', 'Контакты | DevForum')
@section('desc', 'Форма обратной связи')

@section('content')
<h1 class="mb-3">Контакты</h1>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <p class="text-muted mb-4">
            Напишите нам — мы прочитаем сообщение и ответим на указанную почту.
        </p>

        <form method="POST" action="{{ route('contact.send') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Имя</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Сообщение</label>
                <textarea name="message" class="form-control" rows="5" required>{{ old('message') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Капча: {{ $a }} + {{ $b }} = ?</label>
                <input type="number" name="captcha" class="form-control" required
                       value="{{ old('captcha') }}"
                       placeholder="Введите ответ">
                <div class="form-text">Защита от спама (простая проверка).</div>
            </div>

            <button class="btn btn-success w-100">Отправить</button>
        </form>

    </div>
</div>
@endsection
