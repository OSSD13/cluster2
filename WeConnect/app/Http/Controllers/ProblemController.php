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

    public function addForm(Request $req)
    {
        $problem = new Problem();
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
        // Use where() instead of find() to match by prob_id
        $problem = Problem::where('prob_id', $id)->first();

        // If no problem is found, handle it as needed (e.g., return an error or redirect)
        if (!$problem) {
            return redirect()->route('problem.index')->with('error', 'Problem not found.');
        }

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
            'tags'           => 'required|array',
            'tags.*'         => 'string',
            'description'    => 'nullable|string',
        ]);

        $problem = Problem::where('prob_id', $id)->firstOrFail();
        $problem->community_name = $req->community_name;
        $problem->sub_district   = $req->sub_district;
        $problem->district       = $req->district;
        $problem->province       = $req->province;
        $problem->post_code      = $req->postcode;
        $problem->detail         = $req->description;
        $problem->save();

        // Sync tags in the pivot table
        $tagNames = $req->input('tags');  // This will give you the tags array from the form
        $tagIds = [];

        foreach ($tagNames as $name) {
            $tag = Tag::firstOrCreate(['tag_name' => $name]);
            $tagIds[] = $tag->tag_id;
        }

        $problem->tags()->sync($tagIds);

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
