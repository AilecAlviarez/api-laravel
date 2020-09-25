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
    Route::get('/',[\App\Http\Controllers\Admin\AdminController::class,'index']);
    Route::get('/products/{id}',[\App\Http\Controllers\Admin\AdminProductController::class,'show']);
    Route::put('/product/{id}/{idProduct}',[\App\Http\Controllers\Admin\AdminProductController::class,'update']);
    //para que el metodo store pueda recibir un parametro se asigna explicitamente
    Route::post('/products/{id}',[\App\Http\Controllers\Admin\AdminProductController::class,'store']);
    Route::get('/categories',[\App\Http\Controllers\Admin\AdminCategoryController::class,'index']);
    Route::get('/incomes/{id}',[\App\Http\Controllers\Admin\AdminIncomeController::class,'index']);
    Route::get('inventary/{id}',[\App\Http\Controllers\Admin\AdminInventaryController::class,'index']);
    Route::apiResource('/categories',\App\Http\Controllers\Admin\CategoryController::class)->except(['edit','create']);
});
Route::middleware(['api','user'])->prefix('buyer')->group(function(){

});


