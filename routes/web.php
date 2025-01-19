<?php

use App\Http\Controllers\Blogs\BlogCommentsController;
use App\Http\Controllers\Blogs\BlogsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyBlogs\MyBlogsController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsBlogAuthor;
use App\Http\Middleware\IsCommentAuthor;
use App\Http\Middleware\XssSanitization;
use Illuminate\Support\Facades\Route;
use ProtoneMedia\LaravelXssProtection\Middleware\XssCleanInput;

Route::get('/', [BlogsController::class, 'index'])->name('blogs');
Route::get('/blog/{blog}', [BlogsController::class, 'show'])->name('blogs.show');
Route::get('/blogs/category/{category}', [BlogsController::class, 'category'])->name('blogs.category');
Route::get('/search', [BlogsController::class, 'search'])->name('blogs.search');
Route::middleware('auth')->group(function () {
    Route::post('/blogs/comment/{blog}', [BlogCommentsController::class, 'store'])->name('blogs.comment.store');
    Route::post('/blogs/comment/destroy/{comment}', [BlogCommentsController::class, 'destroy'])
        ->middleware(IsCommentAuthor::class)->name('blogs.comment.destroy');
});
Route::prefix('my-blogs')->middleware('auth')->group(function () {
    Route::get('/', [MyBlogsController::class, 'index'])->name('my-blogs');
    Route::get('/create', [MyBlogsController::class, 'create'])->name('my-blogs.create');
    Route::post('/store', [MyBlogsController::class, 'store'])
        ->middleware(XssCleanInput::class)->name('my-blogs.store');
    Route::middleware(IsBlogAuthor::class)->group(function () {
        Route::get('/edit/{blog}', [MyBlogsController::class, 'edit'])->name('my-blogs.edit');
        Route::post('/update/{blog}', [MyBlogsController::class, 'update'])
            ->middleware(XssCleanInput::class)->name('my-blogs.update');
        Route::get('/show/{blog}', [MyBlogsController::class, 'show'])->name('my-blogs.show');
        Route::delete('/destroy/{blog}', [MyBlogsController::class, 'destroy'])->name('my-blogs.destroy');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
