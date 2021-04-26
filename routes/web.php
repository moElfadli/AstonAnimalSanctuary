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
    return view('welcome');
});

Route::get('/hello',function(){
    return 'Hello World!';
   });
   Route::get('list', 'App\Http\Controllers\AccountController@list');
   Route::get('show/{id}', 'App\Http\Controllers\AccountController@show');
   Route::get('display', [App\Http\Controllers\AccountController::class, 'display'])->name('display_account');

   


Auth::routes();

Route::get('/uploadAnimal', [App\Http\Controllers\AccountController::class, 'uploadAnimalForm'])->name('uploadAnimal');
Route::post('/uploadAnimal', [App\Http\Controllers\AccountController::class, 'uploadAnimalData'])->name('animalData');

Route::get('/uploadImage', [App\Http\Controllers\AccountController::class, 'uploadImageForm'])->name('uploadImageForm');
Route::post('/uploadImage', [App\Http\Controllers\AccountController::class, 'uploadImage'])->name('uploadImage');



Route::get('/displayAnimal', [App\Http\Controllers\AccountController::class, 'displayAnimal'])->name('displayAnimal');
Route::post('/displayAnimal', [App\Http\Controllers\AccountController::class, 'adoptionData'])->name('adoptionData');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/managePendingRequestsform', [App\Http\Controllers\AccountController::class, 'managePendingRequestsform'])->name('managerequests');
Route::post('/managePendingRequestsform', [App\Http\Controllers\AccountController::class, 'modifyRequest'])->name('modifyRequest');

Route::get('/approveView', [App\Http\Controllers\AccountController::class, 'approveView'])->name('approveView');
Route::get('/denyView', [App\Http\Controllers\AccountController::class, 'denyView'])->name('denyView');
