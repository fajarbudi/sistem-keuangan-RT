<?php

use App\Http\Controllers\Mobile\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/mobileLogin', [Auth::class, 'mobileLogin']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/coba', function(){
    return 'aaa';
});

Route::get('/cekToken', [Auth::class, 'cekToken'])->middleware('auth:sanctum');