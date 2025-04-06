<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v0', 'middleware' => ['auth']], function () {
    Route::get('/index', [LinkController::class, 'index'])->name('index');
    Route::delete('/delete-link/{link}', [LinkController::class, 'deleteLink'])->name('delete-link');
    Route::get('/user', [LinkController::class, 'checkUser'])->name('check');
});

Route::fallback([AppController::class, 'main']);

