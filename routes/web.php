<?php

use App\Http\Controllers\BankFormController;
use App\Http\Controllers\DonationAgreementController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupporterController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\DonationAgreement;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('supporters', SupporterController::class)
    ->middleware(['auth']); // Protect admin routes
Route::resource('bankforms', BankFormController::class);

Route::resource('donation-agreements', DonationAgreementController::class);

Route::get('/donation-agreements/{record}/print', function ($record) {
    $donationAgreement = DonationAgreement::findOrFail($record);
    return view('filament.resources.donation-agreements.print-preview', compact('donationAgreement'));
})->name('donation-agreements.print');

require __DIR__ . '/auth.php';
