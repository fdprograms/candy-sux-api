<?php

use App\Http\Controllers;
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

Route::post('/login', [Controllers\AuthController::class, 'login']);

Route::get('/status', function () {
    return 'OK';
});

Route::prefix('admin')->middleware(['auth:api'])->group(function () {
    Route::resource('users', Controllers\UserController::class);
    Route::resource('videos', Controllers\VideoController::class);
});
