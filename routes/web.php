<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\PrivateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return view('home');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/students', [App\Http\Controllers\HomeController::class, 'students'])->name('students');

// Route::get('/profile', function () {
//     return view('profile.myProfile');
// })->name('myProfile');
Route::get('/profile', [AccountController::class, 'myProfile'])->name('profile.myProfile');

Route::get('/profile/new', [PrivateController::class, 'newProfile'])->name('newProfile');
Route::post('/profile/new', [PrivateController::class, 'saveProfile'])->name('saveProfile');
Route::get('/profile/edit/{id}', [PrivateController::class, 'editProfile'])->name('editProfile');
Route::post('/profile/edit/{id}', [PrivateController::class, 'updateProfile'])->name('updateProfile');
Route::delete('/profile/delete/{id}', [PrivateController::class, 'deleteProfile'])->name('deleteProfile');
