<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;






Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->group(function () {

    Route::resource('product', ProductController::class);
    Route::get('profile',[AuthController::class,'profile']);
    Route::post('logout',[AuthController::class,'logout']);
    // Route::get('user', function(Request $request){
    //     return $request->user();
    // });

});

