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
    return response()->json(Link::first());
});
Route::get('api/v0/last', function () {
    return response()->json(Link::latest()->first());
});
Route::get('api/v0/index', function () {
    return response()->json(Link::where('points', '>', 10)->orderBy('points', 'desc')->get());
})->name('index')->middleware('auth');
Route::get('/', function () {
    return view('welcome');
})->name('main');
Route::get('/app', function () {
    return view('app');
})->middleware('auth');
