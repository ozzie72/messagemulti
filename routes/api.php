<?php
// routes/api.php
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClientController;

Route::middleware('auth:sanctum')->group(function () {
    // Rutas API para usuarios
    Route::apiResource('users', UserController::class)
        ->names([
            'index' => 'api.users.index',
            'store' => 'api.users.store',
            'show' => 'api.users.show',
            'update' => 'api.users.update',
            'destroy' => 'api.users.destroy'
        ]);
    
    // Ruta adicional para verificación de email
    Route::post('users/{user}/verify-email', [UserController::class, 'verifyEmail'])
        ->name('api.users.verify-email');
    
    // Rutas API para clientes
    Route::apiResource('clients', ClientController::class)
        ->names([
            'index' => 'api.clients.index',
            'store' => 'api.clients.store',
            'show' => 'api.clients.show',
            'update' => 'api.clients.update',
            'destroy' => 'api.clients.destroy'
        ]);
});

// Ruta de login
Route::post('/login', [UserController::class, 'login'])
    ->name('api.login');