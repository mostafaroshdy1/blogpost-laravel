<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckPostOwner;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


// POSTS ROUTES
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show')->where('id', '[0-9]+');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit')->where('id', '[0-9]+')->middleware(CheckPostOwner::class);
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update')->where('id', '[0-9]+');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy')->where('id', '[0-9]+');
Route::get('/posts/trash', [PostController::class, 'showTrash'])->name('posts.trash');


// USERS ROUTES
Route::get('/users', [UserController::class, 'index'])->name('users.index');






Route::fallback(function () {
    return "Route not found";
});
