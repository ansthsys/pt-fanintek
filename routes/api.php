<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PresenceController;

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

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/presences', [PresenceController::class, 'index']);
    Route::post('/presences', [PresenceController::class, 'insert']);

    // Route for Supervisor
    Route::put('/presences/{presenceId}/approve', [PresenceController::class, 'approve'])->whereNumber('presenceId');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
