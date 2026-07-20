<?php

namespace App\Http\Controllers;

use App\Models\Intel;
use App\Models\Mission;
use App\Models\MissLog;
use App\Models\Operation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $operationCount = Operation::where('user_id', Auth::id())->count();

        $missionCount = Mission::whereHas('operation', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        $totalMissions = Mission::whereHas('operation', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        $completedMissions = Mission::whereHas('operation', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->where('status', 'Completed')
        ->count();
        $progress = $totalMissions > 0
            ? round(($completedMissions / $totalMissions) * 100)
            : 0;

        $missLogCount = MissLog::whereHas('mission.operation', function ($query) {
            $query->where('user_id', Auth::id());
        })->count();

        $intelCount = Intel::where('user_id', Auth::id())->count();

        $recentMissions = Mission::whereHas('operation', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->latest()
        ->take(5)
        ->get();

        $recentMissLogs = MissLog::whereHas('mission.operation', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->latest()
        ->take(5)
        ->get();

        $recentIntels = Intel::where('user_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'operationCount',
            'missionCount',
            'missLogCount',
            'intelCount',
            'recentMissions',
            'recentMissLogs',
            'recentIntels',
            'totalMissions',
            'completedMissions',
            'progress'
        ));
    }
}
