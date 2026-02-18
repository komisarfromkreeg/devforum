# DevForum (Laravel)

Учебный проект-форум на Laravel (MVC).
Функционал: регистрация/авторизация, темы (CRUD), поиск, комментарии, админ-панель, форма обратной связи.

## Стек
- Laravel
- PHP 8.2+
- MySQL
- Bootstrap 5

## Возможности
- Auth: регистрация, вход, выход
- Темы: создание, просмотр, редактирование, удаление
- Поиск по заголовку/тексту темы
- Комментарии к темам (для авторизованных)
- Админ-панель (доступ только администратору)
- Форма контактов (обратная связь)

## Архитектура (MVC)
- Models: User, Post, Comment, Feedback
- Controllers: AuthController, PostController, CommentController, AdminPostController, ContactController
- Views: resources/views (Blade)
- Routes: routes/web.php

## Запуск (локально)
1) composer install
2) php artisan key:generate
3) php artisan migrate
4) php artisan serve
Открыть: http://127.0.0.1:8000

## Примечания
- Админ-доступ ограничен middleware AdminOnly
- Формы защищены CSRF (@csrf)
