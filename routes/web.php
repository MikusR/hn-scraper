<?php

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

Route::get('/', function () {
//    echo "<pre>";
    \Illuminate\Support\Facades\Artisan::call('scrape:fromapi');

    \Illuminate\Support\Facades\Artisan::output();
    return;
});
