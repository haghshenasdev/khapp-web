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

Route::get('/{charity}',function (\App\Models\charity $charity){
    return $charity;
    //write home data geter
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('hadis')->group(function (){
    Route::get("random",[\App\Http\Controllers\api\v1\Hadis::class,'random']);
    //Route::get("get",[\App\Http\Controllers\api\v1\Hadis::class,'getById']);
});

Route::prefix('slider')->group(function (){
    Route::get('all',[\App\Http\Controllers\api\v1\Slider::class,'all']);
});
