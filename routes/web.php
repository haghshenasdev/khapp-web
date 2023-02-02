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
Route::get('fk/{sabtid}',[\App\Http\Controllers\Home::class,'showFK']);

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

    Route::group(['prefix' => 'faktoors'],function (){
        Route::get('/', [\App\Http\Controllers\dashboard\Faktoors::class, 'index'])->name('faktoors');
        Route::get('show', [\App\Http\Controllers\dashboard\Faktoors::class, 'show'])->name('showfaktoor');
        Route::get('new', [\App\Http\Controllers\dashboard\Faktoors::class, 'new'])->name('newfaktoor');
        Route::post('new', [\App\Http\Controllers\dashboard\Faktoors::class, 'create'])->name('createfaktoor');

    });

    Route::group(['prefix' => 'darkhasts'],function (){
        Route::get('/', [\App\Http\Controllers\dashboard\Darkhasts::class, 'index'])->name('darkhasts');
        Route::get('show', [\App\Http\Controllers\dashboard\Darkhasts::class, 'show'])->name('showDarkhasts');
        Route::post('show', [\App\Http\Controllers\dashboard\Darkhasts::class, 'update'])->name('updateDarkhasts');
        Route::get('new', [\App\Http\Controllers\dashboard\Darkhasts::class, 'new'])->name('newDarkhasts');
        Route::post('new', [\App\Http\Controllers\dashboard\Darkhasts::class, 'create'])->name('createDarkhasts');
        Route::delete('delete', [\App\Http\Controllers\dashboard\Darkhasts::class, 'delete'])->name('deleteDarkhast');
    });

    Route::group(['prefix' => 'charities','middleware' => 'can:see-charities'],function (){
        Route::get('/', [\App\Http\Controllers\dashboard\Charities::class, 'index'])->name('charities');
        Route::get('new', [\App\Http\Controllers\dashboard\Charities::class, 'new'])->name('newCharity');
        Route::post('new', [\App\Http\Controllers\dashboard\Charities::class, 'create'])->name('createCharity');
        Route::get('show', [\App\Http\Controllers\dashboard\Charities::class, 'show'])->name('showCharity');
        Route::post('show', [\App\Http\Controllers\dashboard\Charities::class, 'update'])->name('updateCharity');
        Route::delete('delete', [\App\Http\Controllers\dashboard\Charities::class, 'delete'])->name('deleteCharity');
    });

    Route::group(['prefix' => 'pooyeshes','middleware' => 'can:see-pooyesh'],function (){
        Route::get('/', [\App\Http\Controllers\dashboard\Pooyeshes::class, 'index'])->name('pooyeshes');
        Route::get('new', [\App\Http\Controllers\dashboard\Pooyeshes::class, 'new'])->name('newPooyeshes');
        Route::post('new', [\App\Http\Controllers\dashboard\Pooyeshes::class, 'create'])->name('createPooyeshes');
        Route::get('show', [\App\Http\Controllers\dashboard\Pooyeshes::class, 'show'])->name('showPooyeshes');
        Route::post('show', [\App\Http\Controllers\dashboard\Pooyeshes::class, 'update'])->name('updatePooyeshes');
        Route::delete('delete', [\App\Http\Controllers\dashboard\Pooyeshes::class, 'delete'])->name('deletePooyeshes');
    });

    Route::group(['prefix' => 'projects','middleware' => 'can:see-projects'],function (){
        Route::get('/', [\App\Http\Controllers\dashboard\Projects::class, 'index'])->name('projects');
        Route::get('new', [\App\Http\Controllers\dashboard\Projects::class, 'new'])->name('newProjects');
        Route::post('new', [\App\Http\Controllers\dashboard\Projects::class, 'create'])->name('createProjects');
        Route::get('show', [\App\Http\Controllers\dashboard\Projects::class, 'show'])->name('showProjects');
        Route::post('show', [\App\Http\Controllers\dashboard\Projects::class, 'update'])->name('updateProjects');
        Route::delete('delete', [\App\Http\Controllers\dashboard\Projects::class, 'delete'])->name('deleteProjects');
    });
});

Auth::routes();

Route::get('invoice/{sabtid}',[\App\Http\Controllers\Pay::class,'invoice']);
Route::post('verify',[\App\Http\Controllers\Pay::class,'verify'])->name('verify_web');
