<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    public function postFrom(Request $req) {
        $community_name = $req->input('community_name');
        $detail = $req->input('detail');
        $latitude = $req->input('latitude');
        $longitude = $req->input('longitude');
        $sub_district = $req->input('sub_district');
        $district = $req->input('district');
        $province = $req->input('province');
        $postcode = $req->input('postcode');

        $data[] = [
            'community_name' => $community_name,
            'latitude' => $latitude,
            'detail' => $detail,
            'longitude' => $longitude,
            'sub_district' => $sub_district,
            'district' => $district,
            'province' => $province,
            'postcode' => $postcode
        ];

        return view('test_addproblem', ['req' => $data]);
    }

    public function addForm(Request $req) {
        $problem = new Problem();
        $problem -> community_name = $req->input('community_name');
        $problem -> detail = $req->input('detail');
        $problem -> latitude = $req->input('latitude');
        $problem -> longitude = $req->input('longitude');
        $problem -> sub_district = $req->input('sub_district');
        $problem -> district = $req->input('district');
        $problem -> province = $req->input('province');
        $problem -> post_code = $req->input('postcode');
        $problem -> usr_id = null;
        $problem -> save();

        return redirect('/test_problem');
    }

    // รับข้อมูลจากฟอร์ม
    public function submit(Request $request)
    {
        // ตรวจสอบข้อมูล
        $request->validate([
            'community_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'issues' => 'required|string',
            'description' => 'nullable|string',
        ]);

        // ดึงข้อมูลทั้งหมด
        $data = [
            'community_name' => $request->input('community_name'),
            'location' => $request->input('location'),
            'issues' => $request->input('issues'),
            'description' => $request->input('description'),
        ];

        // บันทึกข้อมูลหรือส่งต่อ
        // ตัวอย่าง: บันทึกลง DB หรือ session
        // Community::create($data); // กรณีมี Model

        // ส่งต่อไปหน้าถัดไป
        return redirect()->route('user.problem_detail')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว!');;
    }

    public function index()
    {
        $problems = Problem::latest()->get(); // ดึงข้อมูลจากฐานข้อมูล
        return view('user.home', compact('problems')); // ส่งตัวแปรไปที่ View
    }
    public function show($id)
{
    // ใช้ prob_id แทน id
    $problem = Problem::where('prob_id', $id)->firstOrFail();

    // เรียกใช้ View ในโฟลเดอร์ problems
    return view('user.problem_detail', compact('problem'));
}



public function edit($id)
{
    $problem = Problem::where('prob_id', $id)->firstOrFail();
    return view('user.edit_problem', compact('problem'));
}

// ประมวลผลอัพเดต
public function update(Request $req, $id)
{
    $req->validate([
        'community_name' => 'required|string|max:255',
        'sub_district'   => 'required|string|max:255',
        'district'       => 'required|string|max:255',
        'province'       => 'required|string|max:255',
        'postcode'       => 'required|string|max:10',
        'tag_id'         => 'required|exists:tags,tag_id',
        'description'    => 'nullable|string',
    ]);

    $problem = Problem::where('prob_id', $id)->firstOrFail();
    $problem->community_name = $req->community_name;
    $problem->sub_district   = $req->sub_district;
    $problem->district       = $req->district;
    $problem->province       = $req->province;
    $problem->post_code      = $req->postcode;
    $problem->tag_id         = $req->tag_id; // ← ตรงนี้ใช้ tag_id แทน
    $problem->detail         = $req->description;
    $problem->save();

    return redirect()
        ->route('problem.show', $id)
        ->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
}


}
