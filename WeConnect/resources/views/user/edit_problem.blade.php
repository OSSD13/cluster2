@extends('layouts.layout_user')

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

  <body class="bg-gray-100">
    @extends('content')
    <!-- ฟอร์มแจ้งปัญหา -->
    <h1 class="text-2xl font-semibold mt-4 text-left px-6">แก้ไขข้อมูล</h1>
    <div class="p-4">
        <!-- ชื่อชุมชน -->
        <label class="block mt-2 text-sm">ชื่อของชุมชน</label>
        <input type="text" name= "community_name" class="w-full p-2 border rounded" placeholder="กรอกชื่อชุมชน">

        <!-- ที่อยู่ -->
        <label class="block mt-4 text-sm">ที่อยู่ <span class="text-red-500">*</span></label>
         <!-- ช่องที่อยู่เพิ่มเติม -->
         <input id="sub_district" name="sub_district" type="text" placeholder="ตำบล" class="mt-2 w-full border p-2 rounded">
          <input id="district" name="district" type="text" placeholder="อำเภอ" class="mt-2 w-full border p-2 rounded">
          <input id="province" name="province" type="text" placeholder="จังหวัด" class="mt-2 w-full border p-2 rounded">
           <input id="postcode" name="postcode" type="text" placeholder="รหัสไปรษณีย์" class="mt-2 w-full border p-2 rounded">

        <!-- ปัญหาที่พบ -->
        <label class="block mt-4 text-sm">ปัญหาที่พบ <span class="text-red-500">*</span></label>
        <input type="text" name ="issues" class="w-full p-2 border rounded bg-gray-100" value="#ไฟฟ้า">

        <!-- รายละเอียดเพิ่มเติม -->
        <label class="block mt-4 mt-2 text-sm">รายละเอียดเพิ่มเติม</label>
        <textarea name ="description" class="w-full p-2 border rounded"></textarea>


        <!-- ปุ่ม ยืนยัน -->
        <div class="flex justify-center mt-6">
            <button type ="submit" class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
                 ยืนยันข้อมูล
            </button>
        </div>
    </div>
</form>
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
</body>
@endsection
</html>
