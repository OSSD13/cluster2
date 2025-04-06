<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>WeConnect - Confirm Delete</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
<!-- Header -->
<nav class="text-white p-5 flex items-center" style="background-color: #FF9500;">
        <button onclick="toggleMenu()" class="text-white text-2xl flex items-center">
            <span class="mr-2">☰</span>
            <h1 class="text-xl font-bold">WeeeConnect</h1>
        </button>
    </nav>

 <!-- เมนูซ่อน -->
    <div id="menu" class="hidden fixed top-15 left-0 h-full w-64 p-4 bg-white shadow-lg ">
        {{-- <div id="menu" class="hidden bg-white shadow-md absolute h-screen top-15 left-0 w-64 p-4"> --}}
            <ul class="space-y-2">
                <li><a href="#" class="block text-gray-700"> Home</a></li>
                <li><a href="#" class="block text-gray-700" onclick="openGoogleMaps()"> Map</a></li>
                <li><a href="#" class="block text-gray-700"> Form</a></li>
                <li><a href="#" class="block text-gray-700 pt-30"> Log out</a></li>
            </ul>
        </div>

        <div class="flex items-center justify-center min-h-screen">

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