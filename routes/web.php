<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
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

Route::get('/',[\App\Http\Controllers\Home::class,'show']);

Auth::routes();

Route::group(['prefix' => 'dashboard','middleware' => ['auth']],function (){
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('users', [App\Http\Controllers\users::class, 'index'])->name('users')->middleware('can:see-users');
    Route::get('darkhasts', [App\Http\Controllers\Darkhasts::class, 'index'])->name('darkhasts');
    Route::get('charities', [App\Http\Controllers\Charities::class, 'index'])->name('charities')->middleware('can:see-charities');
});

Auth::routes();

Route::get('invoice/{sabtid}',[\App\Http\Controllers\Pay::class,'invoice']);
Route::post('verify',[\App\Http\Controllers\Pay::class,'verify'])->name('verify_web');
