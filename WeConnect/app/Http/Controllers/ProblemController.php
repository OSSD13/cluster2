<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Problem;
use App\Models\Tag;
use App\Models\User;
use App\Models\ProblemHasTag;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
<<<<<<< HEAD
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
=======
>>>>>>> 3c55fde53288f8a734583651173b990c414ae3ea

    public function addForm(Request $req)
    {
        $problem = new Problem();
<<<<<<< HEAD
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
=======
        $problem->community_name = $req->input('community_name');
        $problem->detail = $req->input('detail');
        $problem->latitude = $req->input('latitude');
        $problem->longitude = $req->input('longitude');
        $problem->sub_district = $req->input('sub_district');
        $problem->district = $req->input('district');
        $problem->province = $req->input('province');
        $problem->post_code = $req->input('postcode');
        $problem->usr_id = session('user')->usr_id;
        $problem->save();

        $tags = explode(',', $req->input('tags'));

        foreach ($tags as $tagName) {
            $tagName = trim($tagName);
            if ($tagName === '') continue;

            // ตรวจสอบและบันทึก
            $tag = Tag::firstOrCreate(['tag_name' => $tagName]);
            $problemTag = new ProblemHasTag();
            $problemTag->prob_id = $problem->prob_id;
            $problemTag->tag_id = $tag->tag_id;
            $problemTag->save();
        }

        return redirect()->route('userhome'); // ส่งตัวแปรไปที่ View
>>>>>>> 3c55fde53288f8a734583651173b990c414ae3ea
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
        $problems = Problem::with('tags')->latest()->get(); // ✅ โหลด tags มาด้วย
        return view('user.home', compact('problems'));
    }
    public function showMap()
    {
        // ดึงข้อมูลตำแหน่งจากฐานข้อมูล
        $locations = Problem::all(); // หรือจะใช้ where(), find(), all() แล้วแต่กรณี
        return view('user.open_map', ['locations' => $locations]);
    }

    public function addimage(Request $req)
    {
        $path = $req->file('photo')->store('images', 'public');
        // $image = new Image();
        // $image->img_path = $path;
        // $image->prob_id = null;
        // $image->save();

        print_r($path);
        return view('user.addproblem');
    }

    public function showimage(Request $req)
    {
        $path = Image::find($req);
        $data['path'] = $path;
        dump($data);
        return view('test_problem', ['data' => $data]);
    }

    public function show($id)
    {
        // โหลดปัญหาพร้อม tags ด้วย
        $problem = Problem::with('tags')
            ->where('prob_id', $id)
            ->firstOrFail();

        return view('user.problem_detail', compact('problem'));
    }

    public function edit($id)
    {
        $problem = Problem::findOrFail($id);
        $tags = Tag::all(); // ดึง tag ทั้งหมด
        return view('user.edit_problem', compact('problem', 'tags'));
    }


    // ประมวลผลอัพเดต
    public function update(Request $req, $id)
    {

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

    public function search(Request $request)
    {
        $tag = $request->input('tag');

        // ค้นหาปัญหาตาม tag
        $problems = Problem::whereHas('tags', function ($query) use ($tag) {
            $query->where('tag_name', 'like', '%' . $tag . '%');
        })->get();

        return view('user.home', compact('problems'));
    }

    public function delete($id)
    {
        $problem = Problem::find($id);

        if ($problem) {
            try {
                $problem->delete();
                return redirect('/home')->with('success', 'ปัญหาถูกลบแล้ว');
            } catch (\Exception $e) {
                return redirect('/home')->with('error', 'เกิดข้อผิดพลาดในการลบปัญหา: ' . $e->getMessage());
            }
        }

        return redirect('/home')->with('error', 'ไม่พบปัญหาที่ต้องการลบ');
    }

    public function autocomplete(Request $request)
    {
        $query = $request->input('query');
        $tags = \App\Models\Tag::where('tag_name', 'LIKE', "%{$query}%")
            ->select('tag_name')
            ->limit(5)
            ->get();
        return response()->json($tags);
    }
}

