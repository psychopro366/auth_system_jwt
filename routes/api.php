<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Route Middleware
// Route::group(['middleware' => ['json.response']], function(){
//     Route::post('/register', [AuthController::class, 'register'])->name('register.post');
// });


Route::controller(AuthController::class)->group(function(){
    Route::post('/register', 'register')->name('register.post')->middleware('json.response');
    Route::post('/login', 'login')->name('login.post');
});

