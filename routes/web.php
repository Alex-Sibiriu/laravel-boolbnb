<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HouseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\TomTomController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PaymentController;

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

Route::get('/', [AuthenticatedSessionController::class, 'create'])->name('login');

Route::get('/autocomplete', [TomTomController::class, 'autocomplete'])->name('autocomplete');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');

        // rotte crud messages
        Route::resource('messages', MessageController::class);

        // rotte crud houses
        Route::resource('houses', HouseController::class);

        // rotte custom
        Route::get('orderby/{direction}/{column}', [HouseController::class, 'orderBy'])->name('orderby');

        Route::get('deleted-castles', [HouseController::class, 'deleted'])->name('deleted');

        Route::put('retrieve-castles/{id}', [HouseController::class, 'retrieve'])->name('retrieve');

        Route::get('payment', [PaymentController::class, 'index'])->name('payment.index');
        Route::post('payment/create', [PaymentController::class, 'create'])->name('payment.create');
        Route::get('payment/token', [PaymentController::class, 'generateClientToken'])->name('payment.token');
    });

require __DIR__ . '/auth.php';
