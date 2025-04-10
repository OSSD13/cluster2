<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('manager.dashboard');
    }

    public function getDashboardData()
    {
        $result = DB::table('tags')
            ->leftJoin('problems_has_tags', 'tags.tag_id', '=', 'problems_has_tags.tag_id')
            ->select('tags.tag_name as problem', DB::raw('COUNT(problems_has_tags.prob_id) as population'))
            ->groupBy('tags.tag_name')
            ->orderByDesc('population')
            ->limit(3)
            ->get();

        return response()->json($result);
    }
    public function countProblem()
    {
        $count = DB::table('problems')->count();
        return \view('manager.dashboard', ['count' => $count]);

    }
}




