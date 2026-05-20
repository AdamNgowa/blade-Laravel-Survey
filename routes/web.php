<?php

use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Survey Routes
|--------------------------------------------------------------------------
*/

Route::controller(SurveyController::class)->group(function () {

    Route::get('/', 'landing')->name('landing');

    Route::post('/survey/start', 'start')->name('survey.start');

    Route::get('/survey/{attempt}/question/{index}', 'question')
        ->name('survey.question');

    Route::post('/survey/{attempt}/answer', 'saveAnswer')
        ->name('survey.answer');

    Route::get('/survey/{attempt}/result', 'result')
        ->name('survey.result');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->controller(PurchaseController::class)->group(function (){
    Route::get('/purchase','index')->name('purchase.index');
    Route::post('purchase/checkout','checkout')->name('purchase.checkout');
    Route::get('/purchase/success/{purchase}','success')->name('purchase.success');
    Route::get('/paypal/cancel','cancel')->name('paypal.cancel');
    
});



require __DIR__.'/auth.php';