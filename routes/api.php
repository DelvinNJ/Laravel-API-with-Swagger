<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\CollectionController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('v1/login', [AuthController::class, 'login']);


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'v1',
], function () {
    Route::post('logout', [AuthController::class, 'logout']);

    Route::apiResource('products', ProductController::class);
    // Route::post('products/bulk-insert', [ProductController::class, 'bulkInsert']);
    Route::apiResource('collections', CollectionController::class);
});
