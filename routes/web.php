<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Profile Controller
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/name/update/{id}', [ProfileController::class, 'name_update'])->name('profile.name.update');
Route::post('/profile/image/update/{id}', [ProfileController::class, 'image_update'])->name('profile.image.update');
Route::post('/profile/password/update/{id}', [ProfileController::class, 'password_update'])->name('profile.password.update');
Route::post('/profile/email/update/{id}', [ProfileController::class, 'email_update'])->name('profile.email.update');

// Category Controller


Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::post('/category/insert', [CategoryController::class, 'insert'])->name('category.insert');
Route::post('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/category/status/{id}', [CategoryController::class, 'status'])->name('category.status');



// Tag Controller

Route::get('/tag', [TagController::class, 'index'])->name('tag');
Route::post('/tag/insert', [TagController::class, 'insert'])->name('tag.insert');
Route::post('/tag/status/{id}', [TagController::class, 'status'])->name('tag.status');
Route::post('/tag/delete/{id}', [TagController::class, 'delete'])->name('tag.delete');
Route::post('/tag/update/{id}', [TagController::class, 'update'])->name('tag.update');


// Blog Controller
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/insert/view', [BlogController::class, 'insert_view'])->name('blog.insert.view');
Route::post('/blog/insert', [BlogController::class, 'insert'])->name('blog.insert');
Route::post('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
Route::post('/blog/restore/{id}', [BlogController::class, 'restore'])->name('blog.restore');
Route::post('/blog/restore/delete/{id}', [BlogController::class, 'restore_delete'])->name('blog.restore.delete');


