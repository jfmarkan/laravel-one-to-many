<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController as GuestPageController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\ProjectController as ProjectController;
use App\Http\Controllers\Admin\TypeController as TypeController;

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


Auth::routes();

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){
    Route::get('/home', [AdminPageController::class, 'logged'])->name('home');
    Route::get('/projects/bin', [ProjectController::class, 'binned'])->name('projects.bin');
    Route::delete('/projects/bin/{id}', [ProjectController::class, 'restore'])->name('projects.restore');
    Route::resource('/projects', ProjectController::class);
    Route::resource('/types', TypeController::class);
});

Route::get('/',[GuestPageController::class, 'landing'])->name('guest.welcome');