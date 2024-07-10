<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user', function () {
    return view('user.index');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


// ADMIN ROUTES
Route::prefix('admin')->middleware(['auth', 'multiAuth'])->group(function(){
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    // Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    // Route::get('/category/create', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::get('/categories/{id}/delete', [App\Http\Controllers\Admin\CategoryController::class, 'delete'])->name("categories.delete");


    Route::get('/tags', [App\Http\Controllers\Admin\TagController::class, 'index'])->name("admin.tags");
    Route::get('/tags/create', [App\Http\Controllers\Admin\TagController::class, 'create'])->name("admin.tags.create");
    Route::post('/tags/store', [App\Http\Controllers\Admin\TagController::class, 'store'])->name("admin.tags.store");
    Route::get('/tags/edit/{id}', [App\Http\Controllers\Admin\TagController::class, 'edit'])->name("admin.tags.edit");
    Route::put('/tags/update/{id}', [App\Http\Controllers\Admin\TagController::class, 'update'])->name("admin.tags.update");
    Route::get('/tags/delete/{id}', [App\Http\Controllers\Admin\TagController::class, 'destroy'])->name("admin.tags.destroy");
});

