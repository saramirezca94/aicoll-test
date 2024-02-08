<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityController;

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

Route::get('/', [EntityController::class, 'index']);

Route::get('entities', [EntityController::class, 'index']);
Route::get('entity/{id}', [EntityController::class, 'show']);
Route::get('entity', [EntityController::class, 'create'])->name('new-entity');
