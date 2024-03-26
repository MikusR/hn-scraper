<?php

use App\Models\Link;
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

Route::get('api/v0/first', function () {
//    echo "<pre>";
//    \Illuminate\Support\Facades\Artisan::call('scrape:fromapi');

//    \Illuminate\Support\Facades\Artisan::output();
//    return Link::orderBy('points', 'desc')->paginate(10);
    return response()->json(Link::first());
});
Route::get('api/v0/last', function () {

    return response()->json(Link::latest()->first());
});
Route::get('/welcome', function () {
    return view('welcome');
});
