<?php

use Illuminate\Http\Request;
use App\Http\Resources\ContactResource;

// 連絡先API
Route::apiResource('contact','ContactController');

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

Route::middleware(['cors'])->group(function () {
    Route::options('/{any}',function(){
        return response()->json();
    })->where('any','.*');
    
    // 連絡先API
    Route::apiResource('contact','ContactController');
});
