<?php

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

    Route::get('about',[\App\Http\Controllers\api\v1\AppHomeData::class,'about']);

    Route::get("hadis",[\App\Http\Controllers\api\v1\Hadis::class,'get']);

    Route::get('slider',[\App\Http\Controllers\api\v1\Slider::class,'all']);

    Route::get('project',[\App\Http\Controllers\api\v1\Project::class,'index']);

    Route::get('pooyesh',[\App\Http\Controllers\api\v1\Pooyesh::class,'index']);

    Route::get('type',[\App\Http\Controllers\api\v1\Type::class,'index']);

    //login routs by api
    Route::post('register',[\App\Http\Controllers\api\v1\auth\AuthController::class,'register']);
    Route::post('login',[\App\Http\Controllers\api\v1\auth\AuthController::class,'login']);

    Route::post('verify',[\App\Http\Controllers\api\v1\Pay::class,'verify']);

    Route::group(['prefix' => 'blog'],function (){
        Route::get('post',[\App\Http\Controllers\api\v1\Blog::class,'getPosts']);
    });

    // auth required routs
    Route::group(['middleware' => ['auth:sanctum']],function (){
        Route::post('pay',[\App\Http\Controllers\api\v1\Pay::class,'pay']);

        Route::group(['prefix' => 'profile'],function (){
            Route::get('/',[\App\Http\Controllers\api\v1\profile\Profile::class,'index']);
            Route::post('/update',[\App\Http\Controllers\api\v1\profile\Profile::class,'update']);

            Route::get('/faktoors',[\App\Http\Controllers\api\v1\profile\Faktoor::class,'faktoors']);
            Route::delete('/faktoors/delete',[\App\Http\Controllers\api\v1\profile\Faktoor::class,'delete']);
            Route::get('/faktoors/dl-img',[\App\Http\Controllers\api\v1\profile\Faktoor::class,'dlimg']);

            Route::group(['prefix' => 'darkhasts'],function (){
                Route::get('/',[\App\Http\Controllers\api\v1\profile\Darkhast::class,'index']);

                Route::post('/create',[\App\Http\Controllers\api\v1\profile\Darkhast::class,'create']);
                Route::delete('/delete',[\App\Http\Controllers\api\v1\profile\Darkhast::class,'delete']);
                Route::post('/update',[\App\Http\Controllers\api\v1\profile\Darkhast::class,'update']);

                Route::get('/type',[\App\Http\Controllers\api\v1\profile\Darkhast::class,'type']);
            });
        });

        Route::group(['prefix' => 'marasem'],function(){
            Route::get('/',[\App\Http\Controllers\api\v1\Marasem::class,'getMarasem']);
//            Route::post('/create',[\App\Http\Controllers\api\v1\Marasem::class,'createMarasem']);
        });

        Route::group(['prefix' => 'taj'],function(){
            Route::get('/tarh',[\App\Http\Controllers\api\v1\Tag::class,'getTagTarh']);
            Route::get('/type',[\App\Http\Controllers\api\v1\Tag::class,'getTagType']);
            Route::get('/user-order',[\App\Http\Controllers\api\v1\Tag::class,'getUserOrder']);

            Route::post('/create-order',[\App\Http\Controllers\api\v1\Tag::class,'createOrder']);
//            Route::post('/create',[\App\Http\Controllers\api\v1\Marasem::class,'createMarasem']);
        });
    });
});
