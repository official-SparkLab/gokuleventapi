<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserregisterController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\NewsController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\CartController;
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
Route::PUT('/updateEnquiry/{id}',[EnquiryController::class,"updateEnquiry"]);
Route::GET('/searchAllEnquiry',[EnquiryController::class,"index"]);
Route::GET('/searchByEnquiry/{id}',[EnquiryController::class,"getEnquiry"]);

Route::POST('/addProduct',[ProductController::class,"store"]);
Route::GET('/getAllProducts',[ProductController::class,"index"]);
Route::PUT('/updateProduct/{id}',[ProductController::class,"updateProduct"]);
Route::PUT('/updateTopSale/{id}',[ProductController::class,"updateTopSales"]);
Route::PUT('/deleteProduct/{id}',[ProductController::class,"deleteProduct"]);
Route::GET('/searhById/{id}',[ProductController::class,"getProductByID"]);

Route::POST('/addNews',[NewsController::class,"store"]);
Route::GET('/getAllNews',[NewsController::class,"index"]);
Route::PUT('/updateNews/{id}',[NewsController::class,"UpdateNews"]);
Route::PUT('/deleteNews/{id}',[NewsController::class,"deleteNews"]);
Route::GET('/getNews/{id}',[NewsController::class,"getNews"]);

Route::POST('/addCategory',[CategoryController::class,"store"]);
Route::GET('/getAllCategory',[CategoryController::class,"index"]);
Route::GET('getSingleCategory/{id}',[CategoryController::class,"singleCategory"]);
Route::PUT('/deleteCategory/{id}',[CategoryController::class,"deleteCategory"]);
Route::PUT('/updateCategory/{id}',[CategoryController::class,"updateCategory"]);

Route::POST('/addSubCategory',[SubCategoryController::class,"store"]);
Route::GET('/getAllSubCategory',[SubCategoryController::class,"index"]);
Route::GET('getSingleSubCategory/{id}',[SubCategoryController::class,"singleSubCategory"]);
Route::PUT('/deleteSubCategory/{id}',[SubCategoryController::class,"deleteSubCategory"]);
Route::PUT('/updateSubCategory/{id}',[SubCategoryController::class,"updateSubCategory"]);

Route::POST('/addCart',[CartController::class,"store"]);