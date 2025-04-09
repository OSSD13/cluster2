<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function store(Request $request)
<<<<<<< HEAD
{
    
    $request->validate([
        'tag_name' => 'required|string|max:255',
    ]);

    // ตรวจสอบว่ามีแท็กนี้อยู่แล้วหรือยัง
    if (Tag::where('tag_name', $request->tag_name)->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'แท็กนี้มีอยู่แล้ว'
        ]);
    }

    // ถ้าไม่มี ก็เพิ่มใหม่
    $tag = Tag::create([
        'tag_name' => $request->tag_name,
    ]);

    return response()->json([
        'success' => true,
        'tag' => $tag
    ]);
}

public function fetch()
{
    $tags = \App\Models\Tag::pluck('tag_name'); // หรือ 'name' ตามชื่อ field
    return response()->json($tags);
}

=======
    {
        $request->validate([
            'tag_name' => 'required|string|max:255',
        ]);

        // ตรวจสอบว่ามีแท็กนี้อยู่แล้วหรือยัง
        if (Tag::where('tag_name', $request->tag_name)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'แท็กนี้มีอยู่แล้ว'
            ]);
        }

        // ถ้าไม่มี ก็เพิ่มใหม่
        $tag = Tag::create([
            'tag_name' => $request->tag_name,
        ]);

        return response()->json([
            'success' => true,
            'tag' => $tag
        ]);
    }

    public function fetch()
    {
        $tags = \App\Models\Tag::pluck('tag_name'); // หรือ 'name' ตามชื่อ field
        return response()->json($tags);
    }
>>>>>>> b3f26f8f7862b08511f747ef900598b1121c48dd
}
