<?php

use Illuminate\Support\Facades\Route;
use Semaphore\Http\Controllers\Api\DataController;
use Semaphore\Http\Controllers\Api\NotificationController;

Route::middleware(config('semaphore.routes.middleware.api'))
    ->prefix(config('semaphore.routes.prefix') . '/api')
    ->group(function () {

    Route::get('data/{type}', [DataController::class, 'index'])->name('data');
    Route::get('notification', [NotificationController::class, 'notify'])->name('notification');

});
