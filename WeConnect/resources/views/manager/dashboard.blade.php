@extends ('layouts.layout_manager')
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WeConnect - Dashboard</title>

    <!-- import javascript สร้าง  pie chart และ axios เพื่อดึงข้อมูลจาก MySQL แบบ ajax -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<body class="bg-gray-100">
    @section('content')

    <!-- Dashboard -->
    <h1 class="text-3xl font-bold mb-4"> Dashboard</h1>
    <div class="p-2">
        <!-- mm-dd-yyyy -->
        <label class="block mt-2 text-sm">From</label>

        <!-- สร้าง div สำหรับแสดงกราฟ -->
        <div id="piechart"></div>

        <script type="text/javascript">
            //ดึงข้อมูลแบบ ajax โดยเรียกไฟล์ get_data.php
            axios.get("data.php").then(response => {

                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(function() {
                    //เก็บข้อมูล JSON ที่ส่งจากไฟล์ get_data.php ไว้ในตัวแปร data_from_mysql
                    var data_from_mysql = response.data;
                    var data = []; //สร้างตัวแปรสำหรับข้อมูลที่จะไปแสดงในกราฟ
                    data.push(['Problem', 'Popupulation']);
                    //เพิม problem และ Population ที่ได้จาก MySQL เข้าไปใน data
                    data_from_mysql.map(item => {
                        data.push([item.problem, parseInt(item.population)]);
                    });

                    // กำหนดชื่อกราฟ ความกว่าง และความยาว
                    var options = {
                        'title': 'ปัญหาที่พบบ่อย',
                        'width': 650,
                        'height': 400,
                        sliceVisibilityThreshold: .00001
                    };

                    // สร้างกราฟในtag <div> ที่มี id เป็น "piechart"
                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(google.visualization.arrayToDataTable(data), options);
                });

            });
        </script>

</body>

</html>
@endsection
