<?php

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
    Route::get('/', [\App\Http\Controllers\dashboard\HomeController::class, 'index'])->name('dashboard');
    Route::get('profile', [\App\Http\Controllers\dashboard\Profile::class, 'index'])->name('profile');

    Route::group(['prefix' => 'users','middleware' => 'can:see-users'],function (){
        Route::get('/', [\App\Http\Controllers\dashboard\Users::class, 'index'])->name('users');
        Route::get('show', [\App\Http\Controllers\dashboard\Users::class, 'show'])->name('showUser');
        Route::get('new', [\App\Http\Controllers\dashboard\Users::class, 'new'])->name('newUser');
        Route::post('new', [\App\Http\Controllers\dashboard\Users::class, 'create'])->name('createUser');
    });

    Route::group(['prefix' => 'darkhasts'],function (){
        Route::get('/', [\App\Http\Controllers\dashboard\Darkhasts::class, 'index'])->name('darkhasts');
        Route::get('show', [\App\Http\Controllers\dashboard\Darkhasts::class, 'show'])->name('showDarkhasts');
        Route::get('new', [\App\Http\Controllers\dashboard\Darkhasts::class, 'new'])->name('newDarkhasts');
        Route::post('new', [\App\Http\Controllers\dashboard\Darkhasts::class, 'create'])->name('createDarkhasts');

    });

    Route::group(['prefix' => 'charities','middleware' => 'can:see-charities'],function (){
        Route::get('/', [\App\Http\Controllers\dashboard\Charities::class, 'index'])->name('charities');
        Route::get('new', [\App\Http\Controllers\dashboard\Charities::class, 'new'])->name('newCharity');
        Route::post('new', [\App\Http\Controllers\dashboard\Charities::class, 'create'])->name('createCharity');
        Route::get('show', [\App\Http\Controllers\dashboard\Charities::class, 'show'])->name('showCharity');
    });

    Route::get('pooyeshes', [\App\Http\Controllers\dashboard\Pooyeshes::class, 'index'])->name('pooyeshes')->middleware('can:see-pooyesh');
    Route::get('pooyeshes/show', [\App\Http\Controllers\dashboard\Pooyeshes::class, 'show'])->name('showPooyeshes')->middleware('can:see-pooyesh');

    Route::get('projects', [\App\Http\Controllers\dashboard\Projects::class, 'index'])->name('projects')->middleware('can:see-projects');
});

Auth::routes();

Route::get('invoice/{sabtid}',[\App\Http\Controllers\Pay::class,'invoice']);
Route::post('verify',[\App\Http\Controllers\Pay::class,'verify'])->name('verify_web');
