<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ComposerController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Player\PlayerController;
use App\Http\Controllers\Player\PlaylistController;

// Rute welcome
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('redirect');
    }
    return view('welcome');
})->name('welcome');

// Authentication routes
Auth::routes();

// Redirect after login based on role (handled by LoginController)
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('composers', ComposerController::class);
    Route::resource('songs', SongController::class);
    Route::resource('users', UserController::class);
});

// Player routes for regular users
Route::prefix('player')->name('player.')->middleware(['auth', 'role:user'])->group(function () {
    Route::get('/', [PlayerController::class, 'index'])->name('index');
    Route::get('/browse', [PlayerController::class, 'browse'])->name('browse');
    Route::get('/composers', [PlayerController::class, 'composers'])->name('composers');
    Route::get('/composers/{composer}', [PlayerController::class, 'composerDetail'])->name('composer');
    Route::get('/songs/{song}', [PlayerController::class, 'songDetail'])->name('song');
    Route::get('/search', [PlayerController::class, 'search'])->name('search');
    
    // Playlist routes
    Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index');
    Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create');
    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store');
    Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlists.show');
    Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit');
    Route::put('/playlists/{playlist}', [PlaylistController::class, 'update'])->name('playlists.update');
    Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy');
    
    // Rate limited playlist song operations
    Route::middleware('throttle:60,1')->group(function () {
        Route::post('/playlists/{playlist}/add-song', [PlaylistController::class, 'addSong'])->name('playlists.add-song');
        Route::post('/playlists/{playlist}/remove-song', [PlaylistController::class, 'removeSong'])->name('playlists.remove-song');
        Route::post('/playlists/{playlist}/reorder', [PlaylistController::class, 'reorderSongs'])->name('playlists.reorder');
    });
});

// Redirect authenticated users based on role
Route::get('/redirect', function() {
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    
    // If user has no roles, assign 'user' role
    if (auth()->user()->roles->isEmpty()) {
        auth()->user()->assignRole('user');
    }
    
    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    } else {
        return redirect()->route('player.index');
    }
})->name('redirect');
