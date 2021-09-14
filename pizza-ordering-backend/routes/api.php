<?php

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PizzaCategoryController;

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
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login',[AuthController::class,'login']);
Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/users',[AuthController::class,'users']);
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/logout',[AuthController::class,'logout']);
});
// Route::middleware(['cors'])->group(function () {
    Route::apiResource('/PizzaCategory',PizzaCategoryController::class);
    Route::apiResource('/Pizza',PizzaController::class);
    Route::apiResource('/Customer',CustomerController::class);
    Route::post('/Orders',[OrdersController::class,'store']);
    Route::get('/Orders',[OrdersController::class,'index']);
    Route::get('/Complete/{id}',[OrdersController::class,'completeOrder']);
// });


