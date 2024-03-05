<?php

use App\Http\Controllers\PagesController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

    Route::get('/', [PagesController::class, 'index'])->name('homepage');
    Route::get('/profile/{username}', [PagesController::class, 'profile'])->name('profile');
    Route::get('/img', [PagesController::class, 'viewimg'])->name('viewimg');
    Route::get('/post', [PagesController::class, 'post'])->name('post');
    Route::get('/explore', [PagesController::class, 'explore'])->name('explore');
    Route::get('/relationship', [PagesController::class, 'relationship'])->name('relationship');

    Route::get('/img/1', function () {
        return view('pages.view-img',[
            "title" => "view",
        ]);

    });
});

