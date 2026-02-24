<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Basic Counts
        $totalFeedback = \App\Models\aspirasi::count();
        $totalCompleted = \App\Models\aspirasi::where('status', 'complete')->count();
        $totalInProgress = \App\Models\aspirasi::where('status', 'on_progress')->count();
        $totalUsers = \App\Models\User::count();

        // 2. Category Counts
        $countsByCategory = \App\Models\aspirasi::select('category_id', \Illuminate\Support\Facades\DB::raw('count(*) as total'))
            ->with('kategori')
            ->groupBy('category_id')
            ->get();

        // 3. Weekly Activity Chart (Last 7 Days)
        $endDate = \Carbon\Carbon::now();
        $startDate = \Carbon\Carbon::now()->subDays(6);
        $weeklyData = [];
        
        // Initialize last 7 days with 0
        for ($i = 0; $i < 7; $i++) {
            $date = $startDate->copy()->addDays($i);
            $weeklyData[$date->format('Y-m-d')] = [
                'day_name' => $date->translatedFormat('l'), // Senin, Selasa, etc.
                'complete' => 0,
                'on_progress' => 0
            ];
        }

        $aspirationsLastWeek = \App\Models\aspirasi::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->get();

        foreach ($aspirationsLastWeek as $asp) {
            $dateKey = $asp->created_at->format('Y-m-d');
            if (isset($weeklyData[$dateKey])) {
                if ($asp->status == 'complete') {
                    $weeklyData[$dateKey]['complete']++;
                } else {
                    $weeklyData[$dateKey]['on_progress']++;
                }
            }
        }

        // 4. User Activity
        $activeToday = \App\Models\aspirasi::whereDate('created_at', \Carbon\Carbon::today())->distinct('user_id')->count('user_id');
        $activeThisWeek = \App\Models\aspirasi::whereBetween('created_at', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()])->distinct('user_id')->count('user_id');
        $activeThisMonth = \App\Models\aspirasi::whereMonth('created_at', \Carbon\Carbon::now()->month)->distinct('user_id')->count('user_id');

        // 5. Response Rates
        $respondedCount = \App\Models\aspirasi::whereNotNull('admin_response')->where('admin_response', '!=', '')->count();
        $responseRate = $totalFeedback > 0 ? round(($respondedCount / $totalFeedback) * 100) : 0;
        
        $reviewedRate = $totalFeedback > 0 ? round((($totalCompleted + $totalInProgress) / $totalFeedback) * 100) : 0; 
        $completedRate = $totalFeedback > 0 ? round(($totalCompleted / $totalFeedback) * 100) : 0;

        // 6. Recent Lists
        $completedAspirations = \App\Models\aspirasi::where('status', 'complete')
            ->latest()
            ->take(3)
            ->get();

        $inProgressAspirations = \App\Models\aspirasi::where('status', 'on_progress')
            ->latest()
            ->take(3)
            ->get();

        return view('admin.dashboard', [
            'user' => Auth::user(),
            'totalFeedback' => $totalFeedback,
            'totalCompleted' => $totalCompleted,
            'totalInProgress' => $totalInProgress,
            'totalUsers' => $totalUsers,
            'countsByCategory' => $countsByCategory,
            'weeklyData' => $weeklyData,
            'activeToday' => $activeToday,
            'activeThisWeek' => $activeThisWeek,
            'activeThisMonth' => $activeThisMonth,
            'responseRate' => $responseRate,
            'reviewedRate' => $reviewedRate,
            'completedRate' => $completedRate,
            'completedAspirations' => $completedAspirations,
            'inProgressAspirations' => $inProgressAspirations,
        ]);
    }
}

