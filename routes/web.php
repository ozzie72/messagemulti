<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController; //oswaldo
use App\Http\Controllers\ClientController; //oswaldo
use App\Http\Controllers\DepartmentController; //oswaldo
use App\Http\Controllers\DivitionController; //oswaldo

use App\Models\Divition;
use App\Models\Department;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {


    Route::redirect('settings', 'settings/profile');

 //   Route::resource('users', UserController::class); //oswaldo
    Route::resource('users', UserController::class)->except(['show']);

    Route::resource('divitions', DivitionController::class);

    Route::resource('departments', DepartmentController::class);

    Route::resource('clients', ClientController::class);

    Route::get('users/data', [UsuarioController::class, 'data'])->name('users.data');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

   
    Route::get('divitions/{divition}/departments', function ($divitionId) {
        return response()->json(
            Department::where('divition_id', $divitionId)->get()
        );
    });


});

require __DIR__.'/auth.php';
