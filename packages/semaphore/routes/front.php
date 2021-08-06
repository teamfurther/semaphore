<?php

use Illuminate\Support\Facades\Route;

Route::middleware(config('semaphore.routes.middleware.front'))
    ->namespace('Semaphore')
    ->prefix(config('semaphore.routes.prefix'))
    ->group(function () {

    Route::view('/{vue_capture?}', 'semaphore::app')->where('vue_capture', '^(?!api).*$')->name('index');

});