@extends('layouts.layout')

@section('content')

<body class="bg-gray-100 overflow-y-auto">
    <h1 class="text-2xl font-semibold mt-0 text-left px-6">Dashboard</h1>

    <!-- แสดงเดือนปัจจุบัน -->
    <div class="p-4">
        <label class="block mt-2 text-sm">
            <span id="current-month" class="font-semibold text-lg"></span> </label>
    </div>

    <!-- Pie Chart -->
    <div class="flex justify-center px-4 mt-0">
        <div class="bg-white rounded-2xl shadow-md w-full max-w-screen-xl">
            <div id="piechart" class="mt-6 p-4"></div>

            <!-- สร้าง div สำหรับแสดงกราฟ -->
            <div class="p-1">
                <div id="problembox" class="max-w-7xl h-32 bg-orange-500 rounded-lg p-4 mt-4 mx-auto">
                    <div class="flex justify-center items-center">
                        <h2 class="flex text-4xl font-semibold w-[150px] p-2 text-white">ปัญหาทั้งหมด</h2>
                        <script>
                            var count = {
                                {
                                    $count
                                }
                            };
                            document.getElementById('problemCount').innerHTML = count;
                        </script>
                        <p class="flex text-7xl font-semibold w-[150px] pl-6 text-white">{{$count}}</p>
                    </div>
                </div>

                <div id="topProblem" class="flex mx-auto mt-4 justify-center gap-5 ">
                    <div class="flex  items-center flex-col">
                        <div id="pro1" class=" flex size-24 bg-orange-300 rounded-lg justify-center items-center">
                            <p class="text-6xl text-white font-semibold">1</p>
                        </div>
                        <p class=" text-center text-xl text-gray-700">hi</p>
                    </div>
                    <div class="flex  items-center flex-col">
                        <div id="pro2" class=" flex size-24 bg-orange-400 rounded-lg justify-center items-center">
                            <p class="text-6xl text-white font-semibold">2</p>
                        </div>
                        <p class=" text-center text-xl text-gray-700">hi</p>
                    </div>
                    <div class="flex  items-center flex-col">
                        <div id="pro3" class=" flex size-24 bg-orange-500 rounded-lg justify-center items-center">
                            <p class="text-6xl text-white font-semibold">3</p>
                        </div>
                        <p class=" text-center text-xl text-gray-700">hi</p>
                    </div>
                </div>
            </div>
        </div>



        <!-- Scripts -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script type="text/javascript">
            const currentMonth = new Date().toLocaleString('default', {
                month: 'long',
                year: 'numeric'
            });
            document.getElementById('current-month').innerText = currentMonth;

            axios.get("/dashboard-data").then(response => {
                const rawData = response.data;

                // สร้าง Pie chart
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(() => {
                    const data = [
                        ['Tag Name', 'Count']
                    ];
                    rawData.forEach(item => {
                        data.push([item.problem, parseInt(item.population)]);
                    });

                    const options = {

                        chartArea: {
                            top: 0,
                            height: '80%',
                            width: '100%'
                        },
                        pieHole: 0.6,
                        height: 300,
                        legend: {
                            position: 'bottom'
                        },
                        tooltip: {
                            showColorCode: true
                        },
                        sliceVisibilityThreshold: 0.0001,
                    };

                    const chart = new google.visualization.PieChart(document.getElementById('piechart'));
                    chart.draw(google.visualization.arrayToDataTable(data), options);
                });

                // แสดงชื่อและจำนวนของ 3 อันดับแรก
                rawData.forEach((item, index) => {
                    if (index < 3) {
                        const rank = index + 1;
                        document.querySelector(`#pro${rank} p`).innerText = item.population;
                        document.querySelector(`#pro${rank}`).nextElementSibling.innerText = item.problem;
                    }
                });
            });
        </script>
        <script type="text/javascript">
            // ฟังก์ชันที่จะให้แสดงช่วงวันที่ในเดือนปัจจุบัน
            function getFormattedMonth() {
                const currentDate = new Date();
                const currentMonth = currentDate.toLocaleString('default', {
                    month: 'short'
                });
                const currentYear = currentDate.getFullYear();

                const firstDay = new Date(currentYear, currentDate.getMonth(), 1);
                const lastDay = new Date(currentYear, currentDate.getMonth() + 1, 0);

                const firstDate = firstDay.getDate();
                const lastDate = lastDay.getDate();

                return `From ${firstDate}-${lastDate} ${currentMonth}, ${currentYear}`;
            }

            // กำหนดค่าให้กับ span
            document.getElementById('current-month').innerText = getFormattedMonth();
        </script>

        @endsection