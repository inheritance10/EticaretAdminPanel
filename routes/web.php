<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\YoneticiController;
use App\Http\Controllers\PersonelTaskController;
use App\Http\Controllers\ProductController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


//Admin giriş kontrol route
Route::prefix('admin')->group(function (){
    Route::get('/login',[AuthController::class,'login'])
        ->name('admin.login');

    Route::post('login-authenticate',[AuthController::class,'authenticate'])
        ->name('login.authenticate');

    Route::get('/dashboard',[AuthController::class,'index'])
        ->name('admin.index')->middleware('admin');

    Route::get('/logout',[AuthController::class,'logout'])
        ->name('admin.logout');
});


Route::middleware(['admin'])->group(function (){
   Route::prefix('admin')->group(function (){

       //PERSONEL ROUTE
       Route::resource('personel',PersonelController::class);

       //YÖNETİCİ ROUTE
       Route::resource('yonetici',YoneticiController::class);

       //TASK ROUTE
       Route::resource('gorev',PersonelTaskController::class);

       //PRODUCT ROUTE
       Route::resource('product',ProductController::class);



   });
});



require __DIR__.'/auth.php';
