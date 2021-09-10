<?php

use Illuminate\Support\Facades\Route;
use Semaphore\Http\Controllers\Api\DataController;
use Semaphore\Http\Controllers\Api\NotificationController;
use Semaphore\Http\Controllers\Api\ProjectsController;

Route::middleware(config('semaphore.routes.middleware.api'))
    ->prefix(config('semaphore.routes.prefix') . '/api')
    ->group(function () {

    Route::get('data/{type}', [DataController::class, 'index'])->name('data');
    Route::get('notification', [NotificationController::class, 'notify'])->name('notification');

    Route::get('projects}', [ProjectsController::class, 'index'])->name('projects');
    Route::get('projects/{project}', [ProjectsController::class, 'show'])->name('projects.show');

    });
