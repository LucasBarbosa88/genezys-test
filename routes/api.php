<?php

use App\Http\Controllers\Auth\Api\AddressController;
use App\Http\Controllers\Auth\Api\CepController as ApiCepController;
use App\Http\Controllers\Auth\Api\LoginController;
use App\Http\Controllers\Auth\Api\RegisterController;
use App\Http\Controllers\Auth\Api\UserController;
use App\Http\Controllers\CepController;
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
Route::get('get-cep', [ApiCepController::class, 'getCep']);
Route::prefix('auth')->group(function(){
    Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
    Route::post('register', [RegisterController::class, 'register']);
    Route::post('registerAddress', [AddressController::class, 'registerAddress']);
    Route::post('password', [UserController::class, 'updatePassword']);
    Route::get('users', [UserController::class, 'getAllUsers']);
});
Route::post('login', [LoginController::class, 'login'])->name('login');