<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrivateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

Auth::routes();

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'home'])->name('home');






Route::get('/profile', [ProfileController::class, 'myProfile'])->name('profile.myProfile');
Route::get('/profile/new', [PrivateController::class, 'newProfile'])->name('newProfile');
Route::post('/profile/new', [PrivateController::class, 'saveProfile'])->name('saveProfile');
Route::get('/profile/edit/{id}', [PrivateController::class, 'editProfile'])->name('editProfile');
Route::put('/profile/edit/{id}', [PrivateController::class, 'updateProfile'])->name('updateProfile');
Route::delete('/profile/delete/{id}', [PrivateController::class, 'deleteProfile'])->name('deleteProfile');



Route::get('/profile/gallery/new', [PrivateController::class, 'newGallery'])->name('newGallery');
Route::post('/profile/gallery/new', [PrivateController::class, 'saveGallery'])->name('saveGallery');
Route::get('/profile//gallery/edit/{id}', [PrivateController::class, 'editGallery'])->name('editGallery');
Route::put('/profile/gallery/edit/{id}', [PrivateController::class, 'updateGallery'])->name('updateGallery');
Route::delete('/profile/gallery/delete/{id}', [PrivateController::class, 'deleteGallery'])->name('deleteGallery');

Route::get('/profile/{id}', [ProfileController::class, 'profileView'])->name('profileView');
