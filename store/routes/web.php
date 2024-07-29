<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UploadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(PagesController::class)->group(function () {
    Route::get('/', 'product_list')->name("product_list");
    Route::get('product/{external_code}', 'product')->name("product");
    Route::get('upload/', 'upload')->name("upload");
});


Route::controller(UploadController::class)->group(function () {
    Route::post('upload/', 'upload')->name("upload");
});