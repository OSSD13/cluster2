@extends('layouts.layout_user')
@section('content')

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WeConnect - แจ้งปัญหา</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: Kanit (TH) & Outfit (EN) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_REAL_API_KEY&libraries=places"></script>

    <style>
      body {
        font-family: 'Kanit', 'Outfit', sans-serif;
      }

      :lang(en) {
        font-family: 'Outfit', sans-serif;
      }
    </style>
  </head>

  <h1 class="text-2xl font-semibold mt-4 text-left px-6">แก้ไขข้อมูล</h1>
  <div class="p-4 bg-white rounded-lg shadow mt-4">
    <form action="{{ route('problem.update', $problem->prob_id) }}"
          method="POST"
          enctype="multipart/form-data">
      @csrf
      @method('PUT')

    {{-- ชื่อชุมชน --}}
    <label class="block mt-2 text-sm">ชื่อของชุมชน <span class="text-red-500">*</span></label>
    <input type="text" name="community_name" required
           class="w-full p-2 border rounded"
           placeholder="กรอกชื่อชุมชน"
           value="{{ old('community_name', $problem->community_name) }}">
    @error('community_name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

    {{-- ที่อยู่ --}}
    <label class="block mt-4 text-sm">ที่อยู่ <span class="text-red-500">*</span></label>
    <div class="space-y-2">
      <input type="text" name="sub_district" required placeholder="ตำบล"
             class="w-full p-2 border rounded"
             value="{{ old('sub_district', $problem->sub_district) }}">
      @error('sub_district') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

      <input type="text" name="district" required placeholder="อำเภอ"
             class="w-full p-2 border rounded"
             value="{{ old('district', $problem->district) }}">
      @error('district') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

      <input type="text" name="province" required placeholder="จังหวัด"
             class="w-full p-2 border rounded"
             value="{{ old('province', $problem->province) }}">
      @error('province') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

      <input type="text" name="postcode" required placeholder="รหัสไปรษณีย์"
             class="w-full p-2 border rounded"
             value="{{ old('postcode', $problem->post_code) }}">
      @error('postcode') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
    </div>
{{-- ปัญหาที่พบ --}}
<label for="tag_id" class="block mt-4 text-sm">ปัญหาที่พบ <span class="text-red-500">*</span></label>
<select name="tag_id" id="tag_id" required class="w-full p-2 border rounded bg-gray-100">
    <option value="">-- เลือกประเภทปัญหา --</option>
    @foreach($tags as $tag)
        <option value="{{ $tag->tag_id }}" {{ $tag->tag_id == $problem->tag_id ? 'selected' : '' }}>
            {{ $tag->tag_name }}
        </option>
    @endforeach
</select>
@error('tag_id')
    <p class="text-red-500 text-sm">{{ $message }}</p>
@enderror

    {{-- รายละเอียดเพิ่มเติม --}}
    <label class="block mt-4 text-sm">รายละเอียดเพิ่มเติม</label>
    <textarea name="description"
              class="w-full p-2 border rounded"
              rows="4">{{ old('description', $problem->detail) }}</textarea>
    @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

    {{-- ปุ่มยืนยัน --}}
    <div class="flex justify-center mt-6">
      <button type="submit"
              class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
        บันทึกข้อมูล
      </button>
    </div>
  </form>
</div>
@endsection
</html>
