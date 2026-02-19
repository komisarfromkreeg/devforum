<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminPostController;

use App\Http\Middleware\AdminOnly;

// =====================
// AUTH
// =====================
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// =====================
// HOME (главная)
// =====================
Route::get('/', [HomeController::class, 'index'])->name('home');


// POSTS (публичные)
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// POSTS (только auth) — ВАЖНО: create ДО {slug}
Route::middleware('auth')->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');


// просмотр темы — ПОСЛЕ create
Route::get('/posts/{slug}', [PostController::class, 'show'])->name('posts.show');


    // редактирование темы (только автор)
    Route::get('/posts/{post:slug}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post:slug}', [PostController::class, 'update'])->name('posts.update');

    // удаление темы (только автор)
    Route::delete('/posts/{post:slug}', [PostController::class, 'destroy'])->name('posts.destroy');

    // комментарии
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});


// =====================
// CONTACTS
// =====================
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');


// =====================
// ADMIN (auth + AdminOnly middleware)
// =====================
Route::middleware(['auth', AdminOnly::class])->group(function () {
    Route::get('/admin', fn () => redirect()->route('admin.posts.index'))->name('admin');
    Route::resource('/admin/posts', AdminPostController::class)->names('admin.posts');
});
