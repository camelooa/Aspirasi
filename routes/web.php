<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Root redirect - handles both authenticated and guests
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        return match ($user->roles) {
            'admin', 'super_admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('dashboard'),
        };
    }
    return app(LoginController::class)->index();
})->name('home');

/*
|--------------------------------------------------------------------------
| Guest (not logged in)
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.process');
});


/*
|--------------------------------------------------------------------------
| Authenticated users
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // siswa dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })
    ->middleware('role:siswa')
    ->name('dashboard');
});


/*
|--------------------------------------------------------------------------
| Admin only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin,super_admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/feedback', [FeedbackController::class, 'index'])
            ->name('admin.feedback');

        Route::post('/feedback/{id}/status', [FeedbackController::class, 'updateStatus'])
            ->name('admin.feedback.status');

    });
    