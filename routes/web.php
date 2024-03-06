<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

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
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/proses-login', [AuthController::class, 'proses_login'])->name('proseslogin');
Route::get('/register', [AuthController::class, 'registerform'])->name('register');
Route::post('/proses-register', [AuthController::class, 'proses_register'])->name('prosesregister');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/update-profile/{id}', [PagesController::class, 'updateP'])->name('updateP');
    Route::post('/posts', [PostsController::class, 'posts'])->name('postsF');
    Route::post('/update-post/{id}', [PagesController::class, 'update_post'])->name('update_post');
    Route::post('/komen/{postId}', [PostsController::class, 'komen'])->name('komen');
    
    Route::get('/like/{postId}', [PostsController::class, 'likePost'])->name('like');
    Route::get('/unlike/{postId}', [PostsController::class, 'unlikePost'])->name('unlike');
    Route::get('/delete-post/{id}', [PagesController::class, 'delete_post'])->name('delete_post');

    Route::get('/', [PagesController::class, 'index'])->name('homepage');
    Route::get('/profile/{username}', [PagesController::class, 'profile'])->name('profile');
    Route::get('/img', [PagesController::class, 'viewimg'])->name('viewimg');
    Route::get('/post', [PagesController::class, 'post'])->name('post');
    Route::get('/explore', [PagesController::class, 'explore'])->name('explore');
    Route::get('/relationship', [PagesController::class, 'relationship'])->name('relationship');
    Route::get('/{username}/{id}', [PagesController::class, 'viewimg'])->name('viewimg');

});

