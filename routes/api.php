<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
|
routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
Route::middleware([])->group(function(){
    Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);

});
Route::middleware(['api','admin'])->prefix('admin')->group(function(){
    Route::apiResource('/',\App\Http\Controllers\Admin\AdminController::class)->except(['edit','create']);
    Route::apiResource('/products',\App\Http\Controllers\Admin\AdminProductController::class)->only(['show']);
    //para que el metodo store pueda recibir un parametro se asigna explicitamente

    Route::post('/products/{id}',[\App\Http\Controllers\Admin\AdminProductController::class,'store']);
});

