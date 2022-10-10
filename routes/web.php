<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Backstage\GameController;
use App\Http\Controllers\Backstage\UserController;
use App\Http\Controllers\Backstage\PrizeController;
use App\Http\Controllers\Backstage\SymbolController;
use App\Http\Controllers\Backstage\CampaignsController;
use App\Http\Controllers\Backstage\DashboardController;

Route::prefix('backstage')->name('backstage.')->middleware(['auth', 'setActiveCampaign'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Campaigns
    Route::get('campaigns/{campaign}/use', [CampaignsController::class, 'use'])->name('campaigns.use');
    Route::resource('campaigns', CampaignsController::class);

    Route::group(['middleware' => ['redirectIfNoActiveCampaign']], function () {
        Route::post('/export', [GameController::class, 'export'])->name('games.export');
        Route::resource('games', GameController::class);
        Route::resource('symbols', SymbolController::class);
        Route::resource('prizes', PrizeController::class);
    });

    // Users
    Route::resource('users', UserController::class);
});

// Route::prefix('backstage')->middleware('setActiveCampaign')->group(function () {
//     // Account activation
//     Route::get('activate/{ott}', 'Auth\ActivateAccountController@index')->name('backstage.activate.show');
//     Route::put('activate/{ott}', 'Auth\ActivateAccountController@update')->name('backstage.activate.update');
// });z

Route::get('{campaign:slug}', [FrontendController::class, 'loadCampaign']);
Route::get('/', [FrontendController::class, 'placeholder']);
Route::post('/spin', [FrontendController::class, 'spin']);
Route::post('/check_game_validity', [FrontendController::class, 'check_game_validity']);

