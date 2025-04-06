<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WeConnect - แจ้งปัญหา</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Google Fonts: Kanit (TH) & Outfit (EN) -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100..900&family=Outfit:wght@100..900&display=swap" rel="stylesheet" />

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- Google Maps API -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>
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

<body class="bg-gray-100">

  <nav class="bg-orange-500 text-white p-5 flex items-center">
    <button onclick="toggleMenu()" class="text-white text-2xl flex items-center">
      <span class="mr-2">☰</span>
      <h1 class="text-xl ">WeConnect</h1>
    </button>
  </nav>

  <!-- เมนูซ่อน -->
  <div id="menu" class="hidden fixed top-15 left-0 h-full w-64 p-4 bg-white shadow-lg">
    <ul class="space-y-2">
      <li><a href="#" class="block text-gray-700"> Home</a></li>
      <li><a href="#" class="block text-gray-700" onclick="openGoogleMaps()"> Map</a></li>
      <li><a href="#" class="block text-gray-700"> Form</a></li>
      <li><a href="#" class="block text-gray-700 pt-30"> Log out</a></li>
    </ul>
  </div>

  <!-- ฟอร์มแจ้งปัญหา -->
  <h1 class="text-2xl font-semibold mt-4 text-center">รายละเอียดปัญหา</h1>
  <div class="p-4">
    <label class="block mt-2 text-sm">ชื่อของชุมชน</label>
    <input type="text" class="w-full p-2 border rounded" placeholder="กรอกชื่อชุมชน" />

    <label class="block mt-2 text-sm">ที่อยู่</label>
    <div class="flex border rounded items-center">
      <input id="location" type="text" class="w-full p-2 border-none focus:ring-0" placeholder="กรอกที่อยู่หรือเลือกจากแผนที่" />
      <button onclick="openGoogleMaps()" class="p-2 bg-gray-200">📍</button>
    </div>

    <label class="block mt-2 text-sm">ปัญหา</label>
    <div class="flex gap-2">
      <span class="px-3 py-1 bg-gray-200 text-gray-800 rounded-full">ไฟฟ้า</span>
    </div>

    <label class="block mt-2 text-sm">รายละเอียดปัญหา</label>
    <textarea class="w-full p-2 border rounded"></textarea>

    <label class="block mt-2 text-sm">รูปภาพ</label>
    <div class="flex gap-2 items-center">
      <input type="file" id="imageInput" accept="image/*" class="p-2 border rounded" />
      <div id="preview" class="flex gap-2"></div>
    </div>

    <div class="flex justify-end mt-4 space-x-2">
      <button class="p-2 bg-white-500 text-white rounded" style="font-size: 24px">
        <i class="fa-solid fa-pen-to-square" style="color: black"></i>
      </button>

    <!-- ปุ่มลบ -->
    <button onclick="confirmDelete()" class="p-2 px-5 bg-red-500 text-white rounded">
        <i class="fa-solid fa-trash"></i>
    </button>

    </div>
  </div>

  <script>
    function openGoogleMaps() {
      let address = document.getElementById("location").value;
      let url = "https://www.google.com/maps/search/?api=1&query=" + encodeURIComponent(address);
      window.open(url, "_blank");
    }

    function initAutocomplete() {
      let input = document.getElementById("location");
      let autocomplete = new google.maps.places.Autocomplete(input, {
        types: ['geocode'],
        componentRestrictions: {
          country: "TH"
        }
      });
    }

    function toggleMenu() {
      let menu = document.getElementById("menu");
      menu.classList.toggle("hidden");
    }

    window.onload = initAutocomplete;
  </script>

  <script>
    document.getElementById('imageInput').addEventListener('change', function (event) {
      const preview = document.getElementById('preview');
      preview.innerHTML = ''; // เคลียร์ก่อน

      Array.from(event.target.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
          const img = document.createElement('img');
          img.src = e.target.result;
          img.className = "w-16 h-16 object-cover rounded-md";
          preview.appendChild(img);
        };
        reader.readAsDataURL(file);
      });
    });
  </script>

<script>
    function confirmDelete() {
      Swal.fire({
        icon: 'error',
        title: 'ลบรายการนี้หรือไม่',
        showCancelButton: true,
        confirmButtonText: 'ตกลง',
        cancelButtonText: 'ยกเลิก',
        confirmButtonColor: '#22c55e',   // เขียว
        cancelButtonColor: '#9ca3af',    // เทา
        customClass: {
          title: 'text-red-500 text-lg'
        }
      }).then((result) => {
        if (result.isConfirmed) {
          // แสดงแจ้งเตือนว่าลบเรียบร้อย
          Swal.fire({
            icon: 'success',
            title: 'ข้อมูลของคุณถูกลบแล้ว',
            confirmButtonText: 'กลับหน้าหลัก',
            confirmButtonColor: '#0ea5e9',
          }).then(() => {
            // กลับหน้าหลักหรือรีโหลดก็ได้
            window.location.href = 'index.html'; // เปลี่ยนตามที่ต้องการ
          });
        }
      });
    }
  </script>

</body>

</html>
