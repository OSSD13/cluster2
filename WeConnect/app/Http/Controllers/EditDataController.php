<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditDataController extends Controller
{

    public function index()
    {
        return view('EditData');
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

        // ตัวอย่าง: แสดง log
        \Log::info('Data submitted:', $data);

        // ส่งต่อไปหน้าถัดไป
        return redirect()->route('ProblemDetail')->with('success', 'บันทึกข้อมูลเรียบร้อยแล้ว!');;
    }

}
