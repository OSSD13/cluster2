@extends('layouts.layout')
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

</head>

<body class="bg-gray-100">
  <h1 class="text-2xl font-semibold mt-4 text-left px-6">แก้ไขข้อมูล</h1>
  <div class="p-4 bg-red rounded-lg mt-4">
    <form action="{{ route('problem.update', $problem->prob_id) }}" method="POST">
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
        <input type="text" id="sub_district" name="sub_district" required placeholder="ตำบล"
          class="w-full p-2 border rounded"
          value="{{ old('sub_district', $problem->sub_district) }}">
        @error('sub_district') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <input type="text" id="district" name="district" required placeholder="อำเภอ"
          class="w-full p-2 border rounded"
          value="{{ old('district', $problem->district) }}">
        @error('district') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <input type="text" id="province" name="province" required placeholder="จังหวัด"
          class="w-full p-2 border rounded"
          value="{{ old('province', $problem->province) }}">
        @error('province') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror

        <input type="text" id="postcode" name="postcode" required placeholder="รหัสไปรษณีย์"
          class="w-full p-2 border rounded"
          value="{{ old('postcode', $problem->post_code) }}">
        @error('postcode') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
      </div>
      {{-- ปัญหาที่พบ --}}
      <label for="tags" class="block mt-4 text-sm">ปัญหาที่พบ <span class="text-red-500">*</span></label>
      <div id="tag-container" class="flex flex-wrap gap-2 p-2 border rounded bg-white">
        @forelse ($problem->tags as $tag)
        <span class="tag-item bg-blue-200 text-blue-800 px-2 py-1 rounded-full flex items-center">
          {{ $tag->tag_name }}
          <button type="button" class="ml-2 text-red-500 remove-tag">&times;</button>
          <input type="hidden" name="tags[]" value="{{ $tag->tag_name }}">
        </span>
        @empty
        <p>ไม่มีแท็กสำหรับปัญหานี้</p>
        @endforelse

        <input type="text" id="tag-input" class="flex-grow p-1 outline-none" placeholder="พิมพ์แล้วกด Enter หรือ ,">
      </div>
      <p class="text-sm text-gray-500 mt-1">พิมพ์แล้วกด Enter หรือเครื่องหมายจุลภาค (,)</p>
      @error('tags') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror




      {{-- รายละเอียดเพิ่มเติม --}}
      <label class="block mt-4 text-sm">รายละเอียดเพิ่มเติม <span class="text-red-500">*</span></label>
      <textarea name="description"
        class="w-full p-2 border rounded"
        rows="4"
        oninput="autoResize(this)">{{ old('description', $problem->detail) }}</textarea>
      @error('description')
      <p class="text-red-500 text-sm">{{ $message }}</p>
      @enderror

      <script>
        function autoResize(textarea) {
          // รีเซ็ตความสูงของ textarea ให้เป็นค่าเริ่มต้นก่อน
          textarea.style.height = 'auto';
          // ตั้งความสูงให้เท่ากับเนื้อหาภายใน
          textarea.style.height = (textarea.scrollHeight) + 'px';
        }
      </script>


      {{-- ปุ่มยืนยัน --}}
      <div class="flex justify-center mt-6">
        <button type="submit"
          class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
          บันทึกข้อมูล
        </button>
      </div>
    </form>
  </div>
  <script>
    const tagInput = document.getElementById('tag-input');
    const tagContainer = document.getElementById('tag-container');

    tagInput.addEventListener('keydown', function(e) {
      if (e.key === 'Enter' || e.key === ',') {
        e.preventDefault();
        addTag(tagInput.value.trim());
        tagInput.value = '';
      }
    });

    function addTag(tagName) {
      if (!tagName) return;

      // Prevent duplicates
      const existing = [...document.querySelectorAll('input[name="tags[]"]')]
        .map(i => i.value.toLowerCase());

      if (existing.includes(tagName.toLowerCase())) return;

      const span = document.createElement('span');
      span.className = 'tag-item bg-blue-200 text-blue-800 px-2 py-1 rounded-full flex items-center';
      span.innerHTML = `${tagName}
      <button type="button" class="ml-2 text-red-500 remove-tag">&times;</button>
      <input type="hidden" name="tags[]" value="${tagName}">`;

      tagContainer.insertBefore(span, tagInput);
    }

    tagContainer.addEventListener('click', function(e) {
      if (e.target.classList.contains('remove-tag')) {
        e.target.closest('.tag-item').remove();
      }
    });
  </script>

<script>
    $.Thailand({
        $district: $("#sub_district"), // input ของตำบล
        $amphoe: $("#district"), // input ของอำเภอ
        $province: $("#province"), // input ของจังหวัด
        $zipcode: $("#postcode") // input ของรหัสไปรษณีย์
    });
</script>

</body>
@endsection

</html>