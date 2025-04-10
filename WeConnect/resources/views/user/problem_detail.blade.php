@extends('layouts.layout')

@section('content')

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WeConnect - รายละเอียดปัญหา</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Kanit&family=Outfit&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    body {
      font-family: 'Kanit', 'Outfit', sans-serif;
    }

    :lang(en) {
      font-family: 'Outfit', sans-serif;
    }
  </style>
</head>

<h1 class="text-2xl font-semibold mt-4 text-left px-6">รายละเอียดปัญหา</h1>

<body class="bg-gray-100">
  <div class="p-4 ">
    <!-- ชื่อชุมชน -->
    <label class="block mt-2 text-sm text-gray-700">📍 ชื่อของชุมชน</label>
    <input type="text" class="w-full p-2 border rounded" value="{{ $problem->community_name }}" readonly>

    <!-- ที่อยู่ -->
    <label class="block mt-4 text-sm text-gray-700">📌 ที่อยู่</label>
    <input type="text" class="w-full p-2 border rounded" readonly
      value="ตำบล {{ $problem->sub_district }}, อำเภอ {{ $problem->district }}, จังหวัด {{ $problem->province }}, {{ $problem->post_code }}">

    <!-- ปัญหาที่พบ -->
    <label class="block mt-4 text-sm text-gray-700">⚠️ ปัญหาที่พบ</label>
    <div class="tags-input-wrapper w-full p-2 border rounded">
      <p class="mt-1">
        @foreach($problem->tags as $tag)
        <span class="bg-gray-200 px-2 py-1 rounded inline-block mr-1 mb-1">
          {{ $tag->tag_name }}
        </span>
        @endforeach
      </p>
    </div>

    <!-- รายละเอียดเพิ่มเติม -->
    <label class="block mt-4 text-sm text-gray-700">📝 รายละเอียดเพิ่มเติม</label>
    <textarea id="detail" class="w-full p-2 border rounded" readonly>{{ $problem->detail }}</textarea>

    <script>
      // ฟังก์ชันสำหรับทำให้ textarea ขยายอัตโนมัติ
      const textarea = document.getElementById('detail');
      textarea.style.height = 'auto';
      textarea.style.height = (textarea.scrollHeight) + 'px';

      // ฟังก์ชันที่จะเรียกทุกครั้งที่มีการพิมพ์ข้อมูลลงใน textarea
      textarea.addEventListener('input', function() {
        textarea.style.height = 'auto';
        textarea.style.height = (textarea.scrollHeight) + 'px';
      });
    </script>

    <!-- เพิ่มโดย + วันที่ -->
    <div class="text-sm text-gray-500 mt-6 border-t pt-4">
      เพิ่มโดย: นายxxx xxxxxx <br>
      วันที่แจ้ง: {{ \Carbon\Carbon::parse($problem->created_at)->format('d/m/Y H:i') }}
    </div>

    <!-- Container ปุ่ม -->
    <div class="flex justify-end mt-6 space-x-2">
      {{-- ปุ่มแก้ไข --}}
      <form action="{{ url('/editproblem/' . $problem->prob_id) }}" method="GET">
        @csrf
        <button type="submit"
          class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600 inline-flex items-center">
          <i class="fa-solid fa-pen-to-square mr-1"></i> แก้ไข
        </button>
      </form>

      {{-- ปุ่มลบ --}}
    <form id="delete-form" action="{{ url('/deleteproblem/' . $problem->prob_id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="button" onclick="confirmDelete()" class="p-2 bg-red-500 text-white rounded hover:bg-red-600 inline-flex items-center">
            <i class="fa-solid fa-trash mr-1"></i> ลบ
        </button>
    </form>


    <script>
        function confirmDelete() {
    Swal.fire({
        title: "คุณแน่ใจหรือไม่?",
        text: "หากลบแล้วจะไม่สามารถกู้คืนได้",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form').submit(); // ส่งฟอร์มหลังจากยืนยันการลบ
        }
    });
}

    </script>

  </div>
</body>
@endsection