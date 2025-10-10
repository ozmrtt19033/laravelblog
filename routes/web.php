<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Auth gerektiren route'lar
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Post route'ları (eğer varsa)
    Route::resource('posts', PostController::class);
    // veya
//    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
//    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
//    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
//    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
//    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
//    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
//    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    //kategori işlemleri
    Route::resource('category', CategoryController::class);
    // veya
//    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
//    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
//    Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
//    Route::get('/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
//    Route::put('/category/{category}', [CategoryController::class, 'update'])->name('category.update');
//    Route::delete('/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');
//    Route::get('/category/{category}', [CategoryController::class, 'show'])->name('category.show');

    //Tag işlemleri
    Route::resource('tags', TagsController::class);

    // Veya tek tek yazmak istersen:
//    Route::get('tags', [TagsController::class, 'index'])->name('tags.index');
//    Route::get('tags/create', [TagsController::class, 'create'])->name('tags.create');
//    Route::post('tags', [TagsController::class, 'store'])->name('tags.store');
//    Route::get('tags/{tags}/edit', [TagsController::class, 'edit'])->name('tags.edit');
//    Route::put('tags/{tags}', [TagsController::class, 'update'])->name('tags.update');
//    Route::delete('tags/{tags}', [TagsController::class, 'destroy'])->name('tags.destroy');


});

require __DIR__ . '/auth.php';
