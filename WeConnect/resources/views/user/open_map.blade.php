<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeConnect_Map</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
</head>
<style>
    body {
        font-family: 'Kanit', sans-serif;
    }
    p {
    word-wrap: break-word;   /* ห่อคำเมื่อข้อความยาว */
    overflow-wrap: break-word; /* ห่อคำเมื่อข้อความยาวที่ไม่มีช่องว่าง */
    white-space: normal;      /* ให้ข้อความสามารถห่อบรรทัดใหม่ได้ */
    }
</style>

<body>
    @extends('layouts.layout_user')
    @section('content')

    <div id="map" class="w-full h-screen fixed">

    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>
    <script>
        var map = L.map('map', {
        center: [13.736717, 100.523186], // จุดศูนย์กลาง (กรุงเทพ)
        zoom: 6 ,
        minZoom: 3 ,
        maxBounds: [                     // ขอบเขตของโลก
        [-90, -180],                // ละติจูดล่าง, ลองจิจูดซ้าย
        [90, 180]                   // ละติจูดบน, ลองจิจูดขวา
    ],
    maxBoundsViscosity: 1.0         // ความแข็งแรงของขอบเขต (1.0 = ห้ามออกเลย)
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
       }).addTo(map);


     </script>


    <div class="fixed bottom-0 right-0 w-full max-w-xs mx-auto p-3 rounded-2xl z-40">
        <div id="accordionBtn" class="flex justify-between p-2 rounded-t-2xl cursor-pointer shadow-lg bg-white ">
            <span id="locationTitle" class="font-bold text-lg">ตำแหน่ง</span>
            <span id="arrow" class="w-8 h-8 flex items-center justify-center transition-transform rounded-full bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                </svg>
            </span>
        </div>

        <div id="accordionContent" class="max-h-0 overflow-hidden transition-all duration-300 bg-white rounded-b-2xl overflow-y-auto ">
            <div class="p-2 ">
                <p class="flex text-gray-700 ">
                    ไม่มีข้อมูล กรุณาเลือกตำแหน่งที่ต้องการ
                </p>
                <p class="flex text-gray-700 mt-1">
                </p>
                <p class="flex text-gray-700 mt-1">
                </p>
                <p class="flex text-gray-700 mt-1">
                </p>
            </div>
        </div>
    </div>
    <script>
        let activeMarker = null;

        @foreach ($locations as $loc) (function() {
    var marker = L.marker([{{ $loc->latitude }}, {{ $loc->longitude }}]).addTo(map);
    marker.on('click', function () {
        const content = document.getElementById('accordionContent');
        const arrow = document.getElementById('arrow');

        const isOpen = !content.classList.contains('max-h-0');

        if (activeMarker === marker) {
            content.classList.remove('max-h-[500px]');
            content.classList.add('max-h-0');
            arrow.classList.remove('rotate-180');
            activeMarker = null;
            return;
        }

        activeMarker = marker;

        document.getElementById("locationTitle").innerText = "{{ $loc->community_name }}";
        content.classList.remove('max-h-0');
        content.classList.add('max-h-[500px]');
        arrow.classList.add('rotate-180');

        content.querySelectorAll('p')[0].innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6 pr-2">
                <path fill-rule="evenodd" d="m9.69 18.933.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 0 0 .281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 1 0 3 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 0 0 2.273 1.765 11.842 11.842 0 0 0 .976.544l.062.029.018.008.006.003ZM10 11.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Z" clip-rule="evenodd" />
                  </svg> พิ้นที่ :
     {{ $loc->sub_district }} / {{ $loc->district }} /{{ $loc->province }} / {{ $loc->post_code }}`;
        content.querySelectorAll('p')[1].innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6 pr-2">
                        <path fill-rule="evenodd" d="M8.485 2.495c.673-1.167 2.357-1.167 3.03 0l6.28 10.875c.673 1.167-.17 2.625-1.516 2.625H3.72c-1.347 0-2.189-1.458-1.515-2.625L8.485 2.495ZM10 5a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 5Zm0 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                    </svg> ปัญหา :
{{ $loc->detail }}`;
        content.querySelectorAll('p')[2].innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6 pr-2">
                        <path d="M10 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H10ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.7555 .7555 a= "2" />
                        <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                    </svg> วันที่เพิ่ม :
 {{ $loc->created_at->format('d/m/Y') }}`;
        content.querySelectorAll('p')[3].innerHTML = `
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-6 pr-2">
  <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-6.5 6.326a6.52 6.52 0 0 1-1.5.174 6.487 6.487 0 0 1-5.011-2.36l.49-.98a.423.423 0 0 1 .614-.164l.294.196a.992.992 0 0 0 1.491-1.139l-.197-.593a.252.252 0 0 1 .126-.304l1.973-.987a.938.938 0 0 0 .361-1.359.375.375 0 0 1 .239-.576l.125-.025A2.421 2.421 0 0 0 12.327 6.6l.05-.149a1 1 0 0 0-.242-1.023l-1.489-1.489a.5.5 0 0 1-.146-.353v-.067a6.5 6.5 0 0 1 5.392 9.23 1.398 1.398 0 0 0-.68-.244l-.566-.566a1.5 1.5 0 0 0-1.06-.439h-.172a1.5 1.5 0 0 0-1.06.44l-.593.592a.501.501 0 0 1-.13.093l-1.578.79a1 1 0 0 0-.553.894v.191a1 1 0 0 0 1 1h.5a.5.5 0 0 1 .5.5v.326Z" clip-rule="evenodd" />
</svg>  พิกัด : {{ $loc->latitude }} / {{ $loc->longitude }} `;
    });
})();
@endforeach

        document.getElementById('accordionBtn').addEventListener('click', function () {
        const content = document.getElementById('accordionContent');
        const arrow = document.getElementById('arrow');

        // Toggle เปิด/ปิด accordion ด้วย class
        if (content.classList.contains('max-h-0')) {
            content.classList.remove('max-h-0');
            content.classList.add('max-h-[500px]'); // ปรับตามเนื้อหา
            arrow.classList.add('rotate-180'); // หมุนลูกศร
        } else {
            content.classList.remove('max-h-[500px]');
            content.classList.add('max-h-0');
            arrow.classList.remove('rotate-180');
        }
    });

    </script>

    @endsection
</body>

</html>
