<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AuthorizedOrSigned;
use Illuminate\Support\Facades\Route;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

Route::redirect('/login', '/wink')->name('login');
Route::get('/', HomeController::class)->name('home');

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::middleware(AuthorizedOrSigned::class . ':wink')->get('/preview/{post:slug}', [PostController::class, 'preview'])->name('posts.preview');
Route::feeds();

Route::get('health', HealthCheckResultsController::class);


