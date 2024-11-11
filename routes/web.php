<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ReservationController;
use App\Http\Middleware\RedirectBasedOnRole;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
})->middleware('role.redirect');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/spaces', [SpaceController::class, 'index'])->name('admin.manageSpaces');
    Route::get('/spaces/create', [SpaceController::class, 'create'])->name('admin.createSpace');
    Route::post('/spaces', [SpaceController::class, 'store'])->name('admin.storeSpace');
    Route::get('/spaces/{id}/edit', [SpaceController::class, 'edit'])->name('admin.editSpace');
    Route::put('/spaces/{id}', [SpaceController::class, 'update'])->name('admin.updateSpace');
    Route::delete('/spaces/{id}', [SpaceController::class, 'destroy'])->name('admin.deleteSpace');

    Route::get('/reservations', [ReservationController::class, 'manageReservations'])->name('admin.manageReservations');
    Route::post('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('admin.cancelReservation');
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('admin.updateReservation');
    Route::post('/reservations/{reservation}/update-status', [ReservationController::class, 'updateStatus'])->name('admin.updateStatus');
});

Route::prefix('client')->middleware(['auth', 'role:client'])->group(function () {
    Route::get('/reservation', [ClientController::class, 'showReservationForm'])->name('client.reservation');
    Route::get('/reservation/create', [ClientController::class, 'showCreateReservationForm'])->name('client.createReservation');
    Route::post('/reservation/create', [ClientController::class, 'makeReservation'])->name('client.storeReservation');
    Route::get('/reservation/{id}/edit', [ClientController::class, 'editReservation'])->name('client.editReservation');
    Route::put('/client/reservation/{id}', [ClientController::class, 'updateReservation'])->name('client.updateReservation');
    Route::delete('/reservation/{id}', [ClientController::class, 'deleteReservation'])->name('client.deleteReservation');
});
