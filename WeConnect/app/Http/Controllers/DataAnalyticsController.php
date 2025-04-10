<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class DataAnalyticsController extends Controller
{
    public function show(Request $request)
{
    $province = $request->input('province');
    $district = $request->input('district');
    $sub_district = $request->input('sub_district');

    return view('manager.analytics_result', compact('province', 'district', 'sub_district'));
}


    public function analyze(Request $request)
    {
        $province = $request->input('province');
        $district = $request->input('district');
        $subDistrict = $request->input('sub_district');

        $problems = Problem::where('province', $province)
            ->where('district', $district)
            ->where('sub_district', $subDistrict)
            ->get();

        // แทนที่ groupBy('tag_id') ด้วยการเชื่อมโยงกับ tag ก่อน
        $tagCounts = $problems->flatMap(function ($problem) {
            return $problem->tags; // การเชื่อมโยงระหว่าง Problem กับ Tag
        })->groupBy('id')->map->count(); // นับจำนวนของแต่ละ tag

        // ทำการแมป tag id เป็นชื่อ (หรือค่าสำหรับแท็ก)
        $labels = $tagCounts->keys()->map(function ($tagId) {
            return match ($tagId) {
                1 => 'ไฟฟ้า',
                2 => 'ประปา',
                default => 'อื่นๆ',
            };
        })->toArray();

        $data = $tagCounts->values()->toArray();

        return view('manager.dataanalytics', [
            'tagCounts'   => $tagCounts,
            'labels'      => $labels,
            'data'        => $data,
            'province'    => $province,
            'district'    => $district,
            'subDistrict' => $subDistrict,
        ]);
    }

    public function getAnalyticsData(Request $request)
    {
        $province = $request->input('province');
        $district = $request->input('district');
        $subDistrict = $request->input('sub_district');

        if (!$province || !$district || !$subDistrict) {
            return response()->json([
                'chartData' => ['labels' => [], 'values' => []],
                'tableData' => []
            ]);
        }

        // ดึงปัญหาตามพื้นที่พร้อม tag
        $problems = Problem::with('tags')
            ->where('province', $province)
            ->where('district', $district)
            ->where('sub_district', $subDistrict)
            ->get();

        // นับ tag ทั้งหมดจากปัญหา
        $tagCounts = collect();
        foreach ($problems as $problem) {
            foreach ($problem->tags as $tag) {
                $tagCounts[$tag->name] = ($tagCounts[$tag->name] ?? 0) + 1;
            }
        }

        $labels = $tagCounts->keys()->toArray();
        $values = $tagCounts->values()->toArray();

        // เตรียมข้อมูลตาราง
        $tableData = [];
        foreach ($labels as $index => $label) {
            $tableData[] = [
                'category' => $label,
                'percentage' => $values[$index]
            ];
        }

        return response()->json([
            'chartData' => [
                'labels' => $labels,
                'values' => $values,
            ],
            'tableData' => $tableData
        ]);
    }
}