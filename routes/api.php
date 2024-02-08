<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityApiController;

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

Route::post('entity', [EntityApiController::class, 'save']);
Route::get('entity/{id}', [EntityApiController::class, 'get']);
Route::patch('entity/{id}', [EntityApiController::class, 'update']);
Route::delete('entity/{id}', [EntityApiController::class, 'delete']);
