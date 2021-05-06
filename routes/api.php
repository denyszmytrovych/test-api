<?php

use App\Http\Controllers\Api\ConversionController;
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

Route::get('/conversions', [ConversionController::class, 'index']);
Route::post('/conversions/convert', [ConversionController::class, 'convert']);
Route::get('/conversions/top', [ConversionController::class, 'top']);
