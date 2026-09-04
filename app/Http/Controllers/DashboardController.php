<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\View\View;

class DashboardController extends Controller
{


    public function index(): View
    {
        $now = now();
        $todayVisits = Visit::query()->whereDate('visited_at', today());
        $weekStart = $now->copy()->startOfWeek();
        $monthStart = $now->copy()->startOfMonth();
        $yearStart = $now->copy()->subYear();
        $dailyStart = $now->copy()->subDays(6)->startOfDay();
        $visitsByDate = Visit::query()
            ->whereBetween('visited_at', [$dailyStart, $now])
            ->selectRaw('DATE(visited_at) as visit_date, COUNT(*) as visits')
            ->groupBy('visit_date')
            ->pluck('visits', 'visit_date');

        $weekLabels = [];
        $weekData = [];

        for ($daysAgo = 6; $daysAgo >= 0; $daysAgo--) {
            $date = $now->copy()->subDays($daysAgo);
            $weekLabels[] = $date->translatedFormat('D');
            $weekData[] = $visitsByDate->get($date->toDateString(), 0);
        }

        return view('dashboard.index', [
            'totalVisits' => Visit::count(),
            'visitsToday' => (clone $todayVisits)->count(),
            'uniqueVisitorsToday' => (clone $todayVisits)->distinct('session_id')->count('session_id'),
            'visitPeriodLabels' => ['Hoy', 'Semana', 'Mes', 'Último año'],
            'visitPeriodData' => [
                (clone $todayVisits)->count(),
                Visit::query()->whereBetween('visited_at', [$weekStart, $now])->count(),
                Visit::query()->whereBetween('visited_at', [$monthStart, $now])->count(),
                Visit::query()->whereBetween('visited_at', [$yearStart, $now])->count(),
            ],
            'weekLabels' => $weekLabels,
            'weekData' => $weekData,
            'topPages' => Visit::query()
                ->selectRaw('url, COUNT(*) as visits')
                ->groupBy('url')
                ->orderByDesc('visits')
                ->limit(5)
                ->get(),
            'recentVisits' => Visit::query()
                ->latest('visited_at')
                ->limit(12)
                ->get(),
        ]);
    }
}