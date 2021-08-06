<?php

use App\Http\Api\Controllers\DataController;
use App\Http\Api\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('data/{type}', [DataController::class, 'index'])->name('data');
Route::get('notification', [NotificationController::class, 'notify'])->name('notification');
