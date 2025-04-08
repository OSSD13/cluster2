@extends('layouts.empmenu')

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
    <!-- Header -->
    @section('content')

        <form action=" {{url('/adddaata') }}" method="post">
            @csrf
    <!-- ฟอร์มแจ้งปัญหา -->
    <h1 class="text-2xl font-semibold mt-4 text-left px-6">เพิ่มข้อมูล</h1>
    <div class="p-4">
        <!-- ชื่อชุมชน -->
        <label class="block mt-2 text-sm">ชื่อของชุมชน</label>
        <input type="text" class="w-full p-2 border rounded" placeholder="กรอกชื่อชุมชน">

        <!-- วันที่ & ตำแหน่ง -->
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <label class="block mt-2 text-sm">วันที่ <span class="text-red-500">*</span></label>
                <div class="flex items-center border p-2 rounded">
                    <i class="fa-solid fa-calendar-days"></i>
                    <input type="date" class="w-full border-none focus:ring-0 ml-2">
                </div>
            </div>
            <div>
                <label class="block mt-2 text-sm">ตำแหน่ง <span class="text-red-500">*</span></label>
                <div class="flex items-center border p-2 rounded">
                    <i class="fa-solid fa-location-dot"></i>
                    <input id="location" type="text" class="w-full border-none focus:ring-0 ml-2" placeholder="เลือกตำแหน่งจากแผนที่">
                    <button onclick="openGoogleMaps()" class="ml-2">➤</button>
                </div>
            </div>
        </div>

        <!-- ที่อยู่ -->
        <label class="block mt-4 mt-2 text-sm">ที่อยู่ <span class="text-red-500">*</span></label>
        <div class="flex items-center border p-2 rounded">
            <input type="text" class="w-full border-none focus:ring-0">
            <button class="ml-2">➤</button>
        </div>

        <!-- ปัญหาที่พบ -->
        <label class="block mt-4 mt-2 text-sm">ปัญหาที่พบ <span class="text-red-500">*</span></label>
        <input type="text" class="w-full p-2 border rounded bg-gray-100" value="#ไฟฟ้า" readonly>

        <!-- รายละเอียดเพิ่มเติม -->
        <label class="block mt-4 mt-2 text-sm">รายละเอียดเพิ่มเติม</label>
        <textarea class="w-full p-2 border rounded"></textarea>

        <!-- อัปโหลดรูปภาพ -->
        <label class="block mt-4 mt-2 text-sm">รูปภาพเพิ่มเติม :</label>
        <input type="file" id="imageInput" accept="image/*" class="border p-2 rounded w-full">
        <div id="preview" class="flex gap-2 mt-2"></div>

        <div class="flex justify-center mt-6">
            <a href="{{ url('home') }}" class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
                เพิ่มข้อมูล
            </a>
        </div>
    </form>
        <!-- ปุ่ม ยืนยัน -->
        {{-- <div class="flex justify-center mt-6">
            <button class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
                 ยืนยันข้อมูล
            </button>
        </div> --}}
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
                componentRestrictions: { country: "TH" }
            });
        }

        function toggleMenu() {
            let menu = document.getElementById("menu");
            menu.classList.toggle("hidden");
        }

        window.onload = initAutocomplete;

        document.getElementById('imageInput').addEventListener('change', function(event) {
            const preview = document.getElementById('preview');
            preview.innerHTML = '';

            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = "w-16 h-16 object-cover rounded-md";
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
</body>

</html>
