<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('users')->name('UserApi.')->group(function () { 
   
    Route::resource('', Api\UserController::class)->only(['store']);
    Route::post('/login',[Api\UserController::class,'login'])->name('login');
});

Route::prefix('organizers')->name('OrganizerApi.')->group(function () { 
   
    Route::resource('', Api\OrganizerController::class)->only(['index']);
});
