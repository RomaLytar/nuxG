<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PageAController;

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

Route::get('/', [RegistrationController::class, 'showForm'])->name('home');
Route::post('/register', [RegistrationController::class, 'register'])->name('register');
Route::group(['prefix' => '/pageA/{unique_link}'], function () {
    Route::get('/', [PageAController::class, 'show'])->name('pageA');
    Route::post('/generate', [PageAController::class, 'generateNewLink'])->name('pageA.generate');
    Route::post('/deactivate', [PageAController::class, 'deactivateLink'])->name('pageA.deactivate');
    Route::post('/lucky', [PageAController::class, 'feelingLucky'])->name('pageA.lucky');
    Route::post('/history', [PageAController::class, 'history'])->name('pageA.history');
});
