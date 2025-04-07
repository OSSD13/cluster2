@extends('layouts.empmenu')


<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeConnect - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100">
    @section('content')

    <form action="{{ url('/login') }}" method="post">
        @csrf


    <!-- ฟอร์มแจ้งปัญหา -->
    {{-- <h1 class="text-2xl font-semibold mt-4 text-left px-6">Home</h1>
    <input type="text" placeholder="🔍" class="border px-3 py-1 rounded w-32" />
    <div class="p-4"> --}}

        <div class="flex justify-between items-center px-6 mt-4">
            <h1 class="text-2xl font-semibold">Home</h1>
            <input type="text" placeholder="🔍 ค้นหา" class="border px-3 py-1 rounded w-60" />
        </div>

  <!-- Section แสดงปัญหา -->
  <div id="problem-section" class="max-w-md mx-auto px-4 mt-4 space-y-4"></div>

  <div class="fixed bottom-6 right-6">
    <a href="{{ url('adddata') }}" class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
        เพิ่มข้อมูล
    </a>
</div>
</form>



  <!-- ปุ่ม เพิ่มข้อมูล -->
<div class="fixed bottom-6 right-6">
    <button onclick="showProblem(true)"
        class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
        เพิ่มข้อมูล
    </button>
</div>
</form>


  <script>
    function toggleMenu() {
      const menu = document.getElementById("menu");
      menu.classList.toggle("hidden");
    }

    function showProblem() {
    const section = document.getElementById("problem-section");

    const html = `
        <a href="http://localhost:1302/problemdetail" class="block">
            <div class="bg-white p-4 rounded-xl shadow">
                <p class="text-sm text-gray-500">01/01/2025</p>
                <p class="font-semibold mt-1">เพิ่มโดย : นายxxx xxxxxx</p>
                <p class="mt-1">📍 <strong>สถานที่</strong> : ชุมชนหาดน้ำดำ ตำบล บางพระ อำเภอ ศรีราชา ชลบุรี 20110</p>
                <p class="mt-1">⚠️ <strong>ปัญหา</strong> : <span class="bg-gray-200 px-2 py-1 rounded">ไฟฟ้า</span></p>
                <p class="mt-1">ไฟฟ้าเข้าไม่ถึง</p>
            </div>
        </a>
    `;

    section.insertAdjacentHTML('beforeend', html);
}


    function toggleModal(show) {
        const modal = document.getElementById("popupModal");
        if (show) {
            modal.classList.remove("hidden");
        } else {
            modal.classList.add("hidden");
        }
    }
  </script>
  @endsection
</body>
</html>
