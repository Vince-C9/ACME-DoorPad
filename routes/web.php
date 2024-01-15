<?php

use Illuminate\Support\Facades\Route;
use Vince\AcmeDoorPad\Http\Controllers\AuthoriseAccessController;

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

Route::post('/login', [AuthoriseAccessController::class, 'access_door'])->name('key_access.login');