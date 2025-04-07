<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenStreetMap with Leaflet</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 500px; }
    </style>
</head>
<body>

<h3>แผนที่ OpenStreetMap</h3>
<div id="map"></div>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map', {
        center: [13.7563, 100.5018], // พิกัดกรุงเทพฯ
        zoom: 10, // ระดับการซูมเริ่มต้น
        maxZoom: 19, // ขีดจำกัดซูมที่สูงสุด
        minZoom: 2, // ขีดจำกัดซูมที่ต่ำสุด (ไม่ให้ซูมออกจนเห็นแผนที่โลกมากเกินไป)
        maxBounds: [[-90, -180], [90, 180]], // กำหนดขอบเขตของแผนที่โลก
        maxBoundsViscosity: 1.0 // ป้องกันการเลื่อนออกจากขอบเขตที่กำหนด
    });

    // เพิ่มแผนที่จาก OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // ปักหมุด
    var marker = L.marker([13.7563, 100.5018]).addTo(map);
    marker.bindPopup("<b>K. Udomsak</b>").openPopup();
</script>

</body>
</html>
