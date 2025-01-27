<?php

use App\Http\Controllers\Blogs\BlogCommentsController;
use App\Http\Controllers\Blogs\BlogsController;
use App\Http\Controllers\MyBlogs\MyBlogsController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsBlogAuthor;
use App\Http\Middleware\IsCommentAuthor;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Routes for Blog
|--------------------------------------------------------------------------
*/
Route::get('/blogs/{category?}', [BlogsController::class, 'index'])->name('blogs');
Route::get('/blog/{blog}', [BlogsController::class, 'show'])->name('blogs.show');

/*
|--------------------------------------------------------------------------
| Routes for auth user
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | Routes for user Blogs
    |--------------------------------------------------------------------------
    */
    Route::prefix('my-blogs')->group(function () {
        Route::get('/', [MyBlogsController::class, 'index'])->name('my-blogs');
        Route::get('/create', [MyBlogsController::class, 'create'])->name('my-blogs.create');
        Route::post('/store', [MyBlogsController::class, 'store'])->name('my-blogs.store');
        Route::middleware(IsBlogAuthor::class)->group(function () {
            Route::get('/edit/{blog}', [MyBlogsController::class, 'edit'])->name('my-blogs.edit');
            Route::post('/update/{blog}', [MyBlogsController::class, 'update'])->name('my-blogs.update');
            Route::get('/show/{blog}', [MyBlogsController::class, 'show'])->name('my-blogs.show');
            Route::post('/destroy/{blog}', [MyBlogsController::class, 'destroy'])->name('my-blogs.destroy');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | Routes for user comments
    |--------------------------------------------------------------------------
    */
    Route::post('/blogs/comment/{blog}', [BlogCommentsController::class, 'store'])->name('blogs.comment.store');
    Route::post('/blogs/comment/destroy/{comment}', [BlogCommentsController::class, 'destroy'])
        ->middleware(IsCommentAuthor::class)->name('blogs.comment.destroy');
});

require __DIR__ . '/auth.php';
