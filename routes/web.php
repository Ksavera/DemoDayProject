<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

Auth::routes();

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'home'])->name('home');






Route::get('/profile', [ProfileController::class, 'myProfile'])->name('myProfile');
Route::get('/profile/new', [ProfileController::class, 'newProfile'])->name('newProfile');
Route::post('/profile/new', [ProfileController::class, 'saveProfile'])->name('saveProfile');
Route::get('/profile/edit/{id}', [ProfileController::class, 'editProfile'])->name('editProfile');
Route::put('/profile/edit/{id}', [ProfileController::class, 'updateProfile'])->name('updateProfile');
Route::delete('/profile/delete/{id}', [ProfileController::class, 'deleteProfile'])->name('deleteProfile');



Route::get('/profile/project/new', [ProjectController::class, 'newProject'])->name('newProject');
Route::post('/profile/project/new', [ProjectController::class, 'saveProject'])->name('saveProject');
Route::get('/profile//project/edit/{id}', [ProjectController::class, 'editProject'])->name('editProject');
Route::put('/profile/project/edit/{id}', [ProjectController::class, 'updateProject'])->name('updateProject');
Route::delete('/profile/project/delete/{id}', [ProjectController::class, 'deleteProject'])->name('deleteProject');

Route::get('/profile/{id}', [ProfileController::class, 'profileView'])->name('profileView');

Route::get('/students', [ProfileController::class, 'getProfiles'])->name('students');
Route::get('/projects', [ProjectController::class, 'getProjects'])->name('projects');

Route::get('/students/location/{id}', [ProfileController::class, 'getStudentsFrom'])->name('students.From');
Route::get('/students/profession/{id}', [ProfileController::class, 'getStudentsProfession'])->name('students.Profession');
