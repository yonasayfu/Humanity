<?php
use App\Http\Controllers\SupporterController;
use Illuminate\Support\Facades\Route;

// API routes should be prefixed with 'api' automatically
Route::apiResource('supporters', SupporterController::class);
