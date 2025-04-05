<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Problem; // ตรวจสอบว่ามีการ Import Model

class HomeController extends Controller
{
    public function index()
    {
        $problems = Problem::latest()->get(); // ดึงข้อมูลจากฐานข้อมูล
        return view('home', compact('problems')); // ส่งตัวแปรไปที่ View
    }
}


