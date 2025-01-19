<?php

use App\Http\Controllers\AuthController;
use App\Livewire\HabitTracker;
use App\Livewire\LandingPage;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', LandingPage::class)->name('landing-page');
Route::get('/tracker', HabitTracker::class)->name('tracker');

Route::get('/google/callback', [AuthController::class, 'callback'])->name('google.callback');
Route::get('/google/redirect', [AuthController::class, 'redirect'])->name('google.redirect');
