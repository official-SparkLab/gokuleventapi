<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserregisterController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\NewsController;
use App\Http\Controllers\EnquiryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::POST('/signup',[UserregisterController::class,"store"]);
Route::POST('/userLogin',[UserregisterController::class,"Login"]);
Route::POST('/addEnquiry',[EnquiryController::class,"store"]);

Route::POST('/addProduct',[ProductController::class,"store"]);
Route::GET('/getAllProducts',[ProductController::class,"index"]);
Route::PUT('/updateProduct/{pid}',[ProductController::class,"updateProduct"]);
Route::DELETE('/deleteProduct/{product}',[ProductController::class,"deleteProduct"]);

Route::POST('/addNews',[NewsController::class,"store"]);