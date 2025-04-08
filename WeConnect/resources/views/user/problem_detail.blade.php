@extends('layouts.layout_user')

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

<div class="p-4">
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
        <span class="inline-block bg-gray-200 px-3 py-1 rounded-full text-gray-800">#{{ $problem->problem_type ?? 'ไม่ระบุ' }}</span>
    </div>

    <!-- รายละเอียดเพิ่มเติม -->
    <label class="block mt-4 text-sm text-gray-700">📝 รายละเอียดเพิ่มเติม</label>
    <textarea class="w-full p-2 border rounded" readonly>{{ $problem->detail }}</textarea>

    <!-- รูปภาพ -->
    <label class="block mt-4 text-sm text-gray-700">🖼️ รูปภาพเพิ่มเติม</label>
    @if($problem->image_path)
        <img src="{{ asset('storage/' . $problem->image_path) }}" alt="รูปภาพปัญหา" class="w-48 h-48 object-cover rounded mt-2">
    @else
        <p class="text-gray-500 mt-1">ไม่มีรูปภาพ</p>
    @endif

    <!-- เพิ่มโดย + วันที่ -->
    <div class="text-sm text-gray-500 mt-6 border-t pt-4">
        เพิ่มโดย: นายxxx xxxxxx <br>
        วันที่แจ้ง: {{ \Carbon\Carbon::parse($problem->created_at)->format('d/m/Y H:i') }}
    </div>

    <!-- ปุ่ม -->
    <div class="flex justify-end mt-6 space-x-2">
        <form action="{{ url('/editproblem') }}" method="POST">
            @csrf
            <button type="submit" class="p-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                <i class="fa-solid fa-pen-to-square"></i> แก้ไข
            </button>
        </form>

        <form action="{{ url('home') }}" method="POST" onsubmit="return confirm('คุณต้องการลบข้อมูลนี้ใช่หรือไม่?');">
            @csrf
            <button type="submit" class="p-2 bg-red-500 text-white rounded hover:bg-red-600">
                <i class="fa-solid fa-trash"></i> ลบ
            </button>
        </form>
    </div>
</div>

@endsection



{{-- <body class="bg-gray-100">
  <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow mt-8">
    <h1 class="text-2xl font-bold mb-4 text-center">รายละเอียดปัญหา</h1>

    <!-- ชื่อชุมชน -->
    <div class="mb-4">
      <label class="block text-sm text-gray-700">📍 ชื่อของชุมชน</label>
      <p class="mt-1 text-gray-800">{{ $problem->community_name }}</p>
    </div>

    <!-- ที่อยู่ -->
    <div class="mb-4">
      <label class="block text-sm text-gray-700">📌 ที่อยู่</label>
      <p class="mt-1 text-gray-800">
        ตำบล {{ $problem->sub_district }},
        อำเภอ {{ $problem->district }},
        จังหวัด {{ $problem->province }},
        {{ $problem->post_code }}
      </p>
    </div>

    <!-- ปัญหา -->
    <div class="mb-4">
      <label class="block text-sm text-gray-700">⚠️ ปัญหา</label>
      <span class="inline-block bg-gray-200 px-3 py-1 rounded-full text-gray-800 mt-1">ไฟฟ้า</span>
    </div>

    <!-- รายละเอียดปัญหา -->
    <div class="mb-4">
      <label class="block text-sm text-gray-700">📝 รายละเอียดปัญหา</label>
      <p class="mt-1 text-gray-800">{{ $problem->detail }}</p>
    </div>

    <!-- รูปภาพ -->
    <div class="mb-4">
      <label class="block text-sm text-gray-700">🖼️ รูปภาพ</label>
      @if($problem->image_path)
        <img src="{{ asset('storage/' . $problem->image_path) }}" alt="รูปภาพปัญหา" class="w-48 h-48 object-cover rounded mt-2">
      @else
        <p class="text-gray-500 mt-1">ไม่มีรูปภาพ</p>
      @endif
    </div>

    <!-- เพิ่มโดย + วันที่ -->
    <div class="text-sm text-gray-500 mt-6 border-t pt-4">
      เพิ่มโดย: นายxxx xxxxxx <br>
      วันที่แจ้ง: {{ \Carbon\Carbon::parse($problem->created_at)->format('d/m/Y H:i') }}
    </div>

    <form action="{{url('/editproblem')}}" method="POST">
        @csrf
        <div class="flex justify-end mt-4 space-x-2">
          <button type="submit" class="p-2 bg-white-500 text-white rounded" style="font-size: 24px">
            <i class="fa-solid fa-pen-to-square" style="color: black"></i>
          </button>
      </form>

      <form action="{{ url('home') }}" method="POST" onsubmit="return confirmDelete()">
        <!-- ปุ่มลบ -->
        <button type="submit" onclick="confirmDelete()" class="p-2 px-5 bg-red-500 text-white rounded">
          <i class="fa-solid fa-trash"></i>
        </button>
      </form>



  </div>
</body>

</html>
@endsection --}}
