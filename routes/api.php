<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'v1/{charity}','middleware' => ['charitycheck']],function (){

    Route::get('/',[\App\Http\Controllers\api\v1\AppHomeData::class,'index']);

    Route::get("hadis",[\App\Http\Controllers\api\v1\Hadis::class,'get']);

    Route::get('slider',[\App\Http\Controllers\api\v1\Slider::class,'all']);

    Route::get('project',[\App\Http\Controllers\api\v1\Project::class,'index']);

    Route::get('pooyesh',[\App\Http\Controllers\api\v1\Pooyesh::class,'index']);

    Route::get('type',[\App\Http\Controllers\api\v1\Type::class,'index']);

    //login routs by api
    Route::post('register',[\App\Http\Controllers\api\v1\auth\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\api\v1\auth\AuthController::class,'login']);

    Route::post('verify',[\App\Http\Controllers\api\v1\Pay::class,'verify']);

    // auth required routs
    Route::group(['middleware' => ['auth:sanctum']],function (){
        Route::post('pay',[\App\Http\Controllers\api\v1\Pay::class,'pay']);


        Route::group(['prefix' => 'profile'],function (){
            Route::get('/',[\App\Http\Controllers\api\v1\Profile::class,'index']);

            Route::get('/faktoors',[\App\Http\Controllers\api\v1\Profile::class,'faktoors']);

            Route::get('/darkhasts',[\App\Http\Controllers\api\v1\Profile::class,'darkhasts']);
        });
    });
});
