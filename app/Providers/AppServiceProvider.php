<?php

namespace App\Providers;

use App\Models\aspirasi;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layout.admin', function ($view) {
            $unreadCount = 0;

            try {
                $user = auth()->user();

                if ($user && in_array($user->roles, ['admin', 'super_admin'], true)) {
                    $unreadCount = aspirasi::query()
                        ->where('status', 'on_progress')
                        ->where(function ($query) {
                            $query->whereNull('admin_response')
                                ->orWhere('admin_response', '');
                        })
                        ->count();
                }
            } catch (\Throwable $e) {
                $unreadCount = 0;
            }

            $view->with('adminUnreadCount', $unreadCount);
        });

        View::composer('layout.siswa', function ($view) {
            $notificationCount = 0;

            try {
                $user = auth()->user();

                if ($user && $user->roles === 'siswa') {
                    $notificationCount = aspirasi::query()
                        ->where('user_id', $user->id)
                        ->where('status', 'complete')
                        ->whereNotNull('admin_response')
                        ->where('admin_response', '!=', '')
                        ->count();
                }
            } catch (\Throwable $e) {
                $notificationCount = 0;
            }

            $view->with('siswaNotificationCount', $notificationCount);
        });
    }
}
