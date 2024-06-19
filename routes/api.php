<?php

use App\Http\Controllers\Api\HousesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
// json castelli completi
Route::get('/houses', [HousesController::class, 'index']);

// json castelli vicini
Route::get('/houses/search/{address}/{radius?}', [HousesController::class, 'getNearbyCastles']);

// json servizi
Route::get('/services', [HousesController::class, 'getServices']);

// json dettaglio castello
Route::get('/house-detail/{slug}', [HousesController::class, 'getHouseBySlug']);
