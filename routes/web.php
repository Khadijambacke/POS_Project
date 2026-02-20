<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthControllers;
use App\Http\Controllers\DashboardController;
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
    // Route::get('/dashboardadmin/services', [ServiceController::class, 'index'])->name('servicsadmin');
    // Route::post('/dashboardadmin/services/store', [ServiceController::class, 'store'])->name('storeservice');
    // Route::get('/dashbordadmin/services/{service}/edit', [ServiceController::class, 'edit'])->name('editservice');
    // Route::post('/dashboardadmin/services/{service}/update', [ServiceController::class, 'update'])->name('updateservice');
    // Route::post('/dashboardadmin/services/{service}/delete', [ServiceController::class, 'delete'])->name('deleteservice');
    // Route::get('/dashboardadmin/services/{service}/show', [ServiceController::class, 'show'])->name('servicedetails');
    // ///autre methode pou mes routes et sa bme simplife tout les methodes a c route medecin
    // Route::resource('dashboardadmin/medecin', MedecinController::class)->names('vuemedecin');
    // Route::resource('dashboardadmin/patient', MedecinController::class)->names('vuemedecin');
    // Route::resource('/dashbordadmin/reservations', ReservationController::class)->names('reservationsnadmin')->only(['index', 'update', 'destroy']);
   
});