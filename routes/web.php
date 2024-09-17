<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CreatePostController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::post('/posts', [CreatePostController::class, 'store'])->name('posts.store');

    Route::get('/create_post', [CreatePostController::class, 'create'])->name('posts.create');
    Route::post('/create_post', [CreatePostController::class, 'store'])->name('posts.store');

    Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
});

require __DIR__.'/auth.php';
