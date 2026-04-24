<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\VisitorLog;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'kunjungan');

        // ── Statistik ringkasan ──────────────────────────────────────────────
        $stats = [
            'kunjungan_hari_ini' => VisitorLog::whereDate('visited_at', today())->count(),
            'kunjungan_bulan_ini' => VisitorLog::whereMonth('visited_at', now()->month)
                ->whereYear('visited_at', now()->year)->count(),
            'aktivitas_hari_ini' => ActivityLog::whereDate('created_at', today())->count(),
            'perubahan_data_hari_ini' => ActivityLog::whereIn('type', ['created', 'updated', 'deleted'])
                ->whereDate('created_at', today())->count(),
        ];

        // ── Tab: Riwayat Berkunjung ──────────────────────────────────────────
        $visitors = collect();
        $visitorChart = [];
        if ($tab === 'kunjungan') {
            $visitors = VisitorLog::orderByDesc('visited_at')
                ->paginate(25, ['*'], 'vpage')
                ->withQueryString();

            // Chart 7 hari terakhir
            $visitorChart = collect(range(6, 0))->map(function ($daysAgo) {
                $date = now()->subDays($daysAgo);
                return [
                    'date'  => $date->format('d M'),
                    'count' => VisitorLog::whereDate('visited_at', $date)->count(),
                ];
            })->all();
        }

        // ── Tab: Log Aktivitas ───────────────────────────────────────────────
        $activities = collect();
        if ($tab === 'aktivitas') {
            $query = ActivityLog::with('user')->orderByDesc('created_at');

            if ($request->filled('type')) {
                $query->where('type', $request->type);
            }
            if ($request->filled('search')) {
                $query->where('description', 'like', '%' . $request->search . '%')
                      ->orWhere('subject_label', 'like', '%' . $request->search . '%');
            }

            $activities = $query->paginate(25, ['*'], 'apage')->withQueryString();
        }

        // ── Tab: Perubahan Data ──────────────────────────────────────────────
        $changes = collect();
        if ($tab === 'perubahan') {
            $query = ActivityLog::with('user')
                ->whereIn('type', ['created', 'updated', 'deleted'])
                ->orderByDesc('created_at');

            if ($request->filled('subject_type')) {
                $query->where('subject_type', $request->subject_type);
            }
            if ($request->filled('type')) {
                $query->where('type', $request->type);
            }

            $changes = $query->paginate(20, ['*'], 'cpage')->withQueryString();
        }

        $subjectTypes = ActivityLog::whereIn('type', ['created', 'updated', 'deleted'])
            ->distinct()->pluck('subject_type')->filter()->sort()->values();

        return view('admin.log_aktivitas', compact(
            'tab', 'stats', 'visitors', 'visitorChart', 'activities', 'changes', 'subjectTypes'
        ));
    }

    public function clearVisitors()
    {
        VisitorLog::truncate();
        return back()->with('success', 'Riwayat kunjungan berhasil dihapus.');
    }

    public function clearActivities()
    {
        ActivityLog::whereNotIn('type', ['login', 'logout'])->delete();
        return back()->with('success', 'Log aktivitas berhasil dibersihkan.');
    }
}
