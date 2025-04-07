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
}
