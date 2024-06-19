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

Route::get('/houses', [HousesController::class, 'index']);

Route::get('/houses/search/{address}/{radius?}', [HousesController::class, 'getNearbyCastles']);
