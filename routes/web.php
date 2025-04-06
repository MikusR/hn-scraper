<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'api/v0', 'middleware' => ['auth']], function () {
    Route::get('/index', [LinkController::class, 'index'])->name('index');
    Route::delete('/delete-link/{link}', [LinkController::class, 'deleteLink'])->name('delete-link');
    Route::get('/user', [LinkController::class, 'checkUser'])->name('check');
});

Route::get('/test', function () {
    echo get_current_user() . "<br>";
    echo 'Current directory: ' . getcwd() . "<br>";
    echo 'PHP version: ' . phpversion() . "<br>";
    echo base_path('app') . "<br>";


$dbtest = base_path('app')."/persistent-db/db.txt";
file_put_contents($dbtest, "test");
echo "dbtest= ".$dbtest . "<br>";
echo file_get_contents($dbtest);

});

Route::fallback([AppController::class, 'main']);

