<?php

use App\Http\Controllers\Api\RouteController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Get
Route::get('category/list', [RouteController::class, 'categoryList']);


//POST
Route::post('category/create', [RouteController::class, 'createCategory']);
Route::get('category/delete/{id}', [RouteController::class, 'deleteCategory']);
Route::get('category/details/{id}', [RouteController::class, 'details']);

Route::post('category/update', [RouteController::class, 'update']);
