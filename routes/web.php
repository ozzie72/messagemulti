<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController; 
use App\Http\Controllers\ClientController; 
use App\Http\Controllers\DepartmentController; 
use App\Http\Controllers\DivitionController; 
use App\Http\Controllers\CountryController; 
use App\Http\Controllers\StateController; 
use App\Http\Controllers\CityController; 
use App\Http\Controllers\SettingsController; 
use App\Http\Controllers\LogController; 

use App\Http\Controllers\PdfController; 

//use App\Livewire\Clients\CreateClient;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', function () {
    $linkPrev = 'Inicio';
    $linkCurrent = 'Dashboard';
    return view('dashboard', compact('linkPrev', 'linkCurrent'));
})->middleware(['auth', 'verified'])
->name('dashboard');

Route::get('/test', [PdfController::class, 'index']);

Route::middleware(['auth'])->group(function () {

    Route::redirect('settings', 'settings/profile');

    Route::resource('countries', CountryController::class);

    Route::resource('states', StateController::class);

    Route::resource('cities', CityController::class);

    Route::resource('users', UserController::class);

    Route::resource('divitions', DivitionController::class);

    Route::resource('departments', DepartmentController::class);

    Route::resource('clients', ClientController::class);

    
    Route::get('settings/profile', [SettingsController::class, 'profile'])->name('settings.profile');
    Route::get('settings/password', [SettingsController::class, 'password'])->name('settings.password');
    Route::get('settings/appearance', [SettingsController::class, 'appearance'])->name('settings.appearance');

    Route::get('divitions/{divition}/departments', [DepartmentController::class, 'byDivition']);
    Route::get('countries/{country}/states', [StateController::class, 'ByCountry']);
    Route::get('states/{state}/cities', [CityController::class, 'ByState']);
    
    // Ruta para enviar el correo (protegida adecuadamente en producción)
    Route::post('/users/{user}/send-confirmation', [UserController::class, 'sendConfirmationEmail'])
    ->name('user.send-confirmation');
    
    Route::resource('logs', LogController::class);

});

// Ruta para confirmar el usuario
Route::get('/users/{user}/confirm', [UserController::class, 'confirm'])
->name('user.confirm');

// Ruta para confirmar el usuario
Route::get('/users/{user}/confirmed', [UserController::class, 'confirmed'])
->name('user.confirmed');

require __DIR__.'/auth.php';
