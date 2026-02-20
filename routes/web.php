<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController; 
use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';



Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboardadmin/categories', [CategorieController::class, 'index'])->name('toutcategrie');
    Route::post('/dashboardadmin/categories/store', [CategorieController::class, 'store'])->name('storecategorie');
    Route::get('/dashboardadmin/categories/{id}/edit', [CategorieController::class, 'edit'])->name('editcategorie');
    Route::post('/dashboardadmin/categories/{id}/update', [CategorieController::class, 'update'])->name('updatecategorie');
    Route::delete('/dashboardadmin/categories/{id}', [CategorieController::class, 'delete'])->name(name: 'deletecategorie');
});
