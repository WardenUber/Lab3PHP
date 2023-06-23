<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\DealerShipsController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function() {
    Route::get('/cars', [CarController::class, 'getAll']);
    Route::get('/car/{carId}', [CarController::class, 'get']);
    Route::post('/car', [CarController::class, 'create']);
    Route::delete('/car/{carId}', [CarController::class, 'delete']);
    Route::put('/car/{carId}', [CarController::class, 'replace']);
    
    Route::get('/dealerships', [DealerShipsController::class, 'getAll']);
    Route::get('/dealership/{dealershipID}', [DealerShipsController::class, 'get']);
    Route::get('/dealership/cars/{dealershipID}', [DealerShipsController::class, 'getCars']);
    Route::put('/dealership', [DealerShipsController::class, 'create']);
    Route::patch('/dealership/{dealershipID}', [DealerShipsController::class, 'update']);
});