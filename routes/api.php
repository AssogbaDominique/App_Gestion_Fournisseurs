<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\AuthController;

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



Route::post('/login', [AuthController::class, 'login']);  // Accessible sans authentification

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('categories')->group(function () {
        Route::post('/', [FournisseurController::class, 'store']);
        Route::get('/{id}', [FournisseurController::class, 'show']);
        Route::get('/', [FournisseurController::class, 'showall']);
        Route::put('/{id}', [FournisseurController::class, 'update']);
        Route::delete('/{id}', [FournisseurController::class, 'delete']);
    });

    Route::prefix('fournisseurs')->group(function () {
        Route::post('/', [FournisseurController::class, 'store']);
        Route::get('/{id}', [FournisseurController::class, 'show']);
        Route::get('/', [FournisseurController::class, 'showall']);
        Route::put('/{id}', [FournisseurController::class, 'update']);
        Route::patch('/{id}/desactiver', [FournisseurController::class, 'desactiver']);
        Route::patch('/{id}/archiver', [FournisseurController::class, 'archiver']);
        Route::post('/logout', [AuthController::class, 'logout']);  // Nécessite authentification
    });
});