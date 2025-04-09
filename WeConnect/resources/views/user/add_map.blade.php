@extends('layouts.layout_user')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenStreetMap with Leaflet</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        .center-marker {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 32px;
            height: 32px;
            margin-left: -16px;
            margin-top: -32px;
            background-image: url('https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png');
            background-size: contain;
            background-repeat: no-repeat;
            pointer-events: none;
            z-index: 999;
        }
    </style>
</head>

@section('content')
<div id="map" class="w-full h-screen fixed">
    <div class="center-marker"></div>
</div>

<input id="latitude" name="latitude" type="text" hidden>
<input id="longitude" name="longitude" type="text" hidden>

<div class="fixed inset-x-0 bottom-0 w-full max-w-xs mx-auto p-4 rounded-2xl z-40">
    <div class="flex justify-center items-center mt-6">
        <button onclick=saveToStorage() class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
            ยืนยันตำแหน่ง
        </button>
    </div>
</div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map', {
        center: [13.301889385896738, 100.89829802513124], // จุดศูนย์กลาง (กรุงเทพ)
        zoom: 6,
        minZoom: 3,
        maxBounds: [ // ขอบเขตของโลก
            [-90, -180], // ละติจูดล่าง, ลองจิจูดซ้าย
            [90, 180] // ละติจูดบน, ลองจิจูดขวา
        ],
        maxBoundsViscosity: 1.0 // ความแข็งแรงของขอบเขต (1.0 = ห้ามออกเลย)
    });

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    // ฟังก์ชันอัปเดตพิกัดจากจุดศูนย์กลางของแผนที่
    function updateMarker() {
        var center = map.getCenter();
        var lat = center.lat;
        var lng = center.lng;
        document.getElementById('latitude').value = `${lat}`;
        document.getElementById('longitude').value = `${lng}`;
    }

    // เรียกใช้งานครั้งแรก
    updateMarker();

    // เมื่อผู้ใช้เลื่อนแผนที่
    map.on('moveend', updateMarker);

    function saveToStorage() {
        // const data = {
        //     latitude: document.getElementById('latitude').value,
        //     longitude: document.getElementById('longitude').value
        // };

        // localStorage.setItem('form_data', JSON.stringify(data));
        localStorage.setItem('latitude', document.getElementById('latitude').value);
        localStorage.setItem('longitude', document.getElementById('longitude').value);

        let url = "/addproblem";
        window.open(url, "_self");
    }
</script>

@endsection