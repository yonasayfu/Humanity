<?php
use App\Http\Controllers\SupporterController;
use App\Http\Controllers\BankFormController;
use Illuminate\Support\Facades\Route;

// API routes should be prefixed with 'api' automatically
Route::apiResource('supporters', SupporterController::class);
Route::apiResource('bankforms', BankFormController::class);