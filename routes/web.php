<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuggestionController;
use Illuminate\Support\Facades\Route;

// Home page - redirect to suggestions
Route::get('/', function () {
    return redirect()->route('suggestions.index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User routes (public)
Route::get('/suggestions/create', [SuggestionController::class, 'create'])->name('suggestions.create');
Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');
Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
Route::get('/suggestions/track/{id}', [SuggestionController::class, 'track'])->name('suggestions.track');

// Admin routes (protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/suggestions', [SuggestionController::class, 'list'])->name('suggestions.list');
    Route::get('/suggestions/{id}/edit', [SuggestionController::class, 'edit'])->name('suggestions.edit');
    Route::put('/suggestions/{id}', [SuggestionController::class, 'update'])->name('suggestions.update');
    Route::delete('/suggestions/{id}', [SuggestionController::class, 'destroy'])->name('suggestions.destroy');
    Route::get('/suggestions/{id}/activities', [SuggestionController::class, 'showActivities'])->name('suggestions.activities');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

?>