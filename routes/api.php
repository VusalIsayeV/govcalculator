<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalculatorController;

Route::get('/UserGroup', [CalculatorController::class, 'OneTimePaymentUserGroup']);
Route::get('/ServiceType', [CalculatorController::class, 'OneTimePaymentServiceType']);
Route::get('/B4', [CalculatorController::class, 'OneTimePaymentB4']);
Route::get('/OneTimePaymentB1B3B5', [CalculatorController::class, 'OneTimePaymentB1B3B5']);
Route::post('/OneTimePayment', [CalculatorController::class, 'OneTimePaymentPost']);
