<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicStatsController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\SearchController;


//// Public routes (no auth required)
//Route::get('/games', [PublicStatsController::class, 'games'])->name('games.public');
//Route::get('/stats', [PublicStatsController::class, 'stats'])->name('stats.public');

// Public routes (no auth required) - should be at the top
Route::get('/games', [PublicStatsController::class, 'games'])->name('games.public');
Route::get('/stats', [PublicStatsController::class, 'stats'])->name('stats.public');

// Search & Stats routes (PUBLIC - no authentication required)
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/player/{id}', [SearchController::class, 'showPlayer'])->name('search.player');
Route::get('/team/{id}', [SearchController::class, 'showTeam'])->name('search.team');


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::patch('/profile/image', [ProfileController::class, 'updateImage'])->name('profile.update-image');
    Route::delete('/profile/image', [ProfileController::class, 'deleteImage'])->name('profile.delete-image');
});

// Contract routes - for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/contracts', [ContractController::class, 'index'])->name('contracts.index');
    Route::post('/contracts/{contract}/accept', [ContractController::class, 'accept'])->name('contracts.accept');
    Route::post('/contracts/{contract}/reject', [ContractController::class, 'reject'])->name('contracts.reject');
});

// Contract management - Admin and Teams only
Route::middleware(['auth', 'admin.or.team'])->group(function () {
    Route::get('/contracts/create', [ContractController::class, 'create'])->name('contracts.create');
    Route::post('/contracts', [ContractController::class, 'store'])->name('contracts.store');
    Route::get('/contracts/my-offers', [ContractController::class, 'myOffers'])->name('contracts.my-offers');
    Route::post('/contracts/{contract}/terminate', [ContractController::class, 'terminate'])->name('contracts.terminate');
});

// View all contracts - Admin only
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/contracts/all', [ContractController::class, 'all'])->name('contracts.all');

    // Team management routes
    Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
    Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
    Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
});

// Protected admin routes
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/games/complete', [GameController::class, 'create'])->name('games.create');
    Route::post('/games/complete', [GameController::class, 'store'])->name('games.store');
    Route::get('/games/coaches/{teamId}', [GameController::class, 'getCoaches']);
    Route::get('/games/players/{teamId}', [GameController::class, 'getPlayers']);
});




require __DIR__ . '/auth.php';
