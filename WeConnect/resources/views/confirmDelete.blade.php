<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>WeConnect - Confirm Delete</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

  @if (session('deleted'))
    <!-- Modal ลบสำเร็จ -->
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
      <div class="text-red-500 text-5xl mb-2">✖️</div>
      <p class="text-red-600 text-lg mb-4">ข้อมูลของคุณถูกลบแล้ว</p>
      <a href="{{ url('/dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">กลับหน้าหลัก</a>
    </div>
  @else
    <!-- Modal ยืนยันลบ -->
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
      <div class="text-red-500 text-5xl mb-2">✖️</div>
      <p class="text-red-600 text-lg mb-4">ลบรายการนี้หรือไม่</p>
      <div class="flex justify-center gap-4">
        <a href="{{ url('/dashboard') }}" class="bg-gray-400 text-white px-4 py-2 rounded">ยกเลิก</a>
        <form action="{{ url('/confirmDelete') }}" method="post">
          @csrf
          <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">ตกลง</button>
        </form>
      </div>
    </div>
  @endif

</body>
</html>