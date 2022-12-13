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

Route::prefix('v1/{charity}')->group(function (){

    Route::get('/',[\App\Http\Controllers\api\v1\AppHomeData::class,'index']);

    Route::get("hadis",[\App\Http\Controllers\api\v1\Hadis::class,'get']);

    Route::get('slider',[\App\Http\Controllers\api\v1\Slider::class,'all']);

    Route::get('project',[\App\Http\Controllers\api\v1\Project::class,'index']);

    Route::get('pooyesh',[\App\Http\Controllers\api\v1\Pooyesh::class,'index']);

    Route::get('type',[\App\Http\Controllers\api\v1\Type::class,'index']);

    //login routs by api
    Route::post('register',[\App\Http\Controllers\api\v1\auth\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\api\v1\auth\AuthController::class,'login']);

    // auth required routs
    Route::group(['middleware' => ['auth:sanctum']],function (){
        Route::get('pay',[\App\Http\Controllers\api\v1\Pay::class,'index']);
    });
});
