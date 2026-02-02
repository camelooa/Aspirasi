<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Root redirect - handles both authenticated and guests
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    if (auth()->check()) {
        $user = auth()->user();
        if (in_array($user->roles, ['admin', 'super_admin'])) {
            return redirect()->route('admin.dashboard');
        }
        if ($user->roles === 'siswa') {
            return redirect()->route('siswa.dashboard');
        }
        return redirect()->route('login');
    }
    return redirect()->route('login');
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
});

/*
|--------------------------------------------------------------------------
| Student only
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])
        ->name('siswa.dashboard');
    
    // aspirasi history for siswa
    Route::get('/aspirasi', [SiswaController::class, 'aspirasisaya'])
        ->name('siswa.aspirasisaya');
    Route::get('/aspirasi/create', [SiswaController::class, 'buataspirasi'])
        ->name('siswa.buataspirasi');
    Route::post('/aspirasi', [SiswaController::class, 'storeAspirasi'])
        ->name('siswa.aspirasi.store');
    Route::get('/aspirasi-orang-lain', [SiswaController::class, 'aspirasioranglain'])
        ->name('siswa.aspirasioranglain');
    Route::get('/aspirasi/{id}', [SiswaController::class, 'showAspirasi'])
        ->name('siswa.aspirasi.show');
    Route::post('/aspirasi/{id}/comment', [App\Http\Controllers\CommentController::class, 'store'])
        ->name('siswa.aspirasi.comment');
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

        Route::get('/statistics', [DashboardController::class, 'statistics'])
            ->name('admin.statistics');

        Route::get('/feedback', [FeedbackController::class, 'index'])
            ->name('admin.feedback');

        Route::get('/feedback/{id}', [FeedbackController::class, 'show'])
            ->name('admin.feedback.show');

        Route::post('/feedback/{id}/reply', [FeedbackController::class, 'reply'])
            ->name('admin.feedback.reply');

        Route::post('/feedback/{id}/status', [FeedbackController::class, 'updateStatus'])
            ->name('admin.feedback.status');

        Route::get('/log', [LogController::class, 'index'])
            ->name('admin.log');

        Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])
            ->name('admin.users.index');
        Route::get('/users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])
            ->name('admin.users.create');
        Route::post('/users', [App\Http\Controllers\Admin\UserController::class, 'store'])
            ->name('admin.users.store');
    });