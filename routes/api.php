<?php
use App\Http\Controllers\SupporterController;
use App\Http\Controllers\BankFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationAgreementController;

// API routes should be prefixed with 'api' automatically
Route::apiResource('supporters', SupporterController::class);
Route::apiResource('bankforms', BankFormController::class);
Route::apiResource('donation-agreements', DonationAgreementController::class);
