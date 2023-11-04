<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontCategoryBlog;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FrontTagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
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

// frontend start



Route::get('/', [FrontendController::class, 'index'])->name('root');

// this is for category related blogs
Route::get('/root/category/blog/{id}', [FrontCategoryBlog::class, 'index'])->name('root.category.blog');
// this is for single blog details
Route::get('/root/blog/single/{id}', [FrontCategoryBlog::class, 'single'])->name('root.single');
Route::get('/root/tag/blog/{id}', [FrontTagController::class, 'index'])->name('root.tag.blog');



// Route::get('/', function () {
//     return view('welcome');
// });

// for registration off

Auth::routes(['register' => false]);
// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
// dashboard starts

// Profile Controller
Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('/profile/name/update/{id}', [ProfileController::class, 'name_update'])->name('profile.name.update');
Route::post('/profile/image/update/{id}', [ProfileController::class, 'image_update'])->name('profile.image.update');
Route::post('/profile/password/update/{id}', [ProfileController::class, 'password_update'])->name('profile.password.update');
Route::post('/profile/email/update/{id}', [ProfileController::class, 'email_update'])->name('profile.email.update');

// Settings Controller
Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
Route::post('/admin/insert', [SettingsController::class, 'insert'])->name('admin.insert');
Route::post('/role/assign', [SettingsController::class, 'role_update'])->name('role.update');




// Category Controller


Route::get('/category', [CategoryController::class, 'index'])->middleware('rolecheck')->name('category');
Route::post('/category/insert', [CategoryController::class, 'insert'])->middleware('rolecheck')->name('category.insert');
Route::post('/category/delete/{id}', [CategoryController::class, 'delete'])->middleware('rolecheck')->name('category.delete');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->middleware('rolecheck')->name('category.update');
Route::post('/category/status/{id}', [CategoryController::class, 'status'])->middleware('rolecheck')->name('category.status');



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
Route::get('/blog/edit/view/{id}', [BlogController::class, 'edit_view'])->name('blog.edit.view');
Route::post('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
Route::get('/blog/feature/update/{id}', [BlogController::class, 'feature'])->name('blog.feature');
Route::get('/blog/status/{id}', [BlogController::class, 'status'])->name('blog.status');


