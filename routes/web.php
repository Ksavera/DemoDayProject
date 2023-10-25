<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PrivateController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/profile', [AccountController::class, 'myProfile'])->name('profile.myProfile');
Route::get('/profile/new', [PrivateController::class, 'newProfile'])->name('newProfile');
Route::post('/profile/new', [PrivateController::class, 'saveProfile'])->name('saveProfile');
Route::get('/profile/edit/{id}', [PrivateController::class, 'editProfile'])->name('editProfile');
Route::post('/profile/edit/{id}', [PrivateController::class, 'updateProfile'])->name('updateProfile');
Route::get('/profile/delete/{id}', [PrivateController::class, 'deleteProfile'])->name('deleteProfile');


Route::get('/profile/gallery/new', [PrivateController::class, 'newGallery'])->name('newGallery');
