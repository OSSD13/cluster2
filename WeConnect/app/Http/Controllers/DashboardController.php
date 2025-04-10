<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Problem;

class DashboardController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // 1. จำนวนปัญหาทั้งหมดในเดือนปัจจุบัน
        $totalProblems = DB::table('problems')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count();

        // 2. ดึง 3 อันดับ tag ที่ถูกใช้มากที่สุด
        $data = DB::table('problems')
        ->join('tags', 'problems.tag_id', '=', 'tags.tag_id')
        ->select('tags.tag_name', DB::raw('COUNT() as count'))
        ->whereYear('problems.created_at', 2025)
        ->whereMonth('problems.created_at', 4)
        ->groupBy('tags.tag_name')
        ->orderByDesc('count')
        ->limit(3)
        ->get();


        // 3. คำนวณ % ของแต่ละแท็ก
        $tagPercentages = $data->map(function ($tag) use ($totalProblems) {
            $percentage = $totalProblems > 0 ? round(($tag->count / $totalProblems), 100, 0) : 0;
            return [
                'name' => $tag->tag_name,
                'count' => $tag->count,
                'percentage' => $percentage
            ];
        });

        return view('manager.dashboard', [
            'totalProblems' => $totalProblems,
            'tagData' => $tagPercentages,
        ]);
    }
    public function getChartData()
{
    $result = DB::table('problems')
        ->join('tags', 'problems.tag_id', '=', 'tags.tag_id')
        ->select('tags.tag_name as problem', DB::raw('count() as population'))
        ->groupBy('tags.tag_name')
        ->get();

    return response()->json($result);}

public function showChart()
{
    $problems = Problem::select('type', DB::raw('count(*) as total'))
                        ->groupBy('type')
                        ->get();

    $labels = $problems->pluck('type');
    $data = $problems->pluck('total');

    return view('chart', compact('labels', 'data'));
}
}
