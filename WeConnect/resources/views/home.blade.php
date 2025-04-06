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

    <nav class="bg-orange-500 text-white p-5 flex items-center">
        <button onclick="toggleMenu()" class="text-white text-2xl flex items-center">
            <span class="mr-2">≡</span>
            <h1 class="text-xl font-bold">WeConnect</h1>
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


  <!-- ปุ่ม เพิ่มข้อมูล -->
<div class="fixed bottom-6 right-6">
    <button onclick="showProblem(true)"
        class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
        เพิ่มข้อมูล
    </button>
</div>



  <script>
    function toggleMenu() {
      const menu = document.getElementById("menu");
      menu.classList.toggle("hidden");
    }

    function showProblem() {
      const section = document.getElementById("problem-section");

      const html = `
        <div class="bg-white p-4 rounded-xl shadow">
          <p class="text-sm text-gray-500">01/01/2025</p>
          <p class="font-semibold mt-1">เพิ่มโดย : นายxxx xxxxxx</p>
          <p class="mt-1">📍 <strong>สถานที่</strong> : ชุมชนหาดน้ำดำ ตำบล บางพระ อำเภอ ศรีราชา ชลบุรี 20110</p>
          <p class="mt-1">⚠️ <strong>ปัญหา</strong> : <span class="bg-gray-200 px-2 py-1 rounded">ไฟฟ้า</span></p>
          <p class="mt-1">ไฟฟ้าเข้าไม่ถึง</p>
        </div>
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












</body>

</html>
