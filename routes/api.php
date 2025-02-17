<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\PatientController;
use App\Http\Controllers\API\CategoryController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('roles',RoleController::class);
Route::apiResource('categories',CategoryController::class);
Route::apiResource('users',UserController::class);
Route::apiResource('doctors',DoctorController::class);
Route::apiResource('patients',PatientController::class);
