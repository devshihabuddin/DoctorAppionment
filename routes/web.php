<?php

use App\Http\Controllers\AppionmentController;
use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('welcome');
});

Route::get('/backend', function () {
    return view('backend');
});

Route::get('/admin', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//__doctor controller__//
Route::resource('doctors', DoctorController::class);
Route::get('/changeStatus', [DoctorController::class, 'changeStatus'])->name('changeStatus');

//___appionment controller__//
Route::get('/appionment', [AppionmentController::class, 'index'])->name('appionment.index');
//__getDoctor__//
Route::post('/getDoctor', [AppionmentController::class, 'getDoctor']);
//__getFee__//
Route::post('/getFee', [AppionmentController::class, 'getFee']);
//__appionment store__//
Route::post('/appionment/store',[AppionmentController::class, 'appionmentStore']);
