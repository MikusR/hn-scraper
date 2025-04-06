<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\LinkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


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
    echo storage_path() . "<br>";
    $filePath = 'persistent-db/file.txt'; // Adjust the path as needed
if (Storage::exists($filePath)) {
    $contents = Storage::get($filePath);
    echo $contents. "<br>";
} else {
    echo "File does not exist.";
}
$dbtest = base_path('app')."/persistent-db/db.txt";
echo "dbtest= ".$dbtest . "<br>";
echo file_get_contents($dbtest);
Storage::put($filePath, "write test");
});

Route::fallback([AppController::class, 'main']);

