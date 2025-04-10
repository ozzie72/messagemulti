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

//use App\Models\Divition;
use App\Models\Department;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::redirect('settings', 'settings/profile');

    Route::resource('countries', CountryController::class);

    Route::resource('states', StateController::class);

    Route::resource('cities', CityController::class);

    Route::resource('users', UserController::class);

    Route::resource('divitions', DivitionController::class);

    Route::resource('departments', DepartmentController::class);

    Route::resource('clients', ClientController::class);

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('divitions/{divition}/departments', [DepartmentController::class, 'byDivition']);
    Route::get('countries/{country}/states', [StateController::class, 'ByCountry']);
    Route::get('states/{state}/cities', [CityController::class, 'ByState']);

    // Ruta para enviar el correo (protegida adecuadamente en producción)
    Route::post('/users/{user}/send-confirmation', [UserController::class, 'sendConfirmationEmail'])
    ->name('user.send-confirmation');

    // Ruta para confirmar la cuenta
    Route::get('/users/{user}/confirm', [UserController::class, 'confirm'])
    ->name('user.confirm');

});

require __DIR__.'/auth.php';
