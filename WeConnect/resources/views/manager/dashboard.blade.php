@extends('layouts.layout')

@section('content')
<div class="bg-gray-100 overflow-y-auto min-h-screen">
    <h1 class="text-2xl font-semibold mt-0 text-left px-6 pt-4">Dashboard</h1>

    <!-- แสดงเดือนปัจจุบัน -->
    <div class="p-4">
        <label class="block mt-2 text-sm">
            <span id="current-month" class="font-semibold text-lg"></span>
        </label>
    </div>

    <!-- Pie Chart -->
    <div class="flex justify-center px-4 mt-0">
        <div class="bg-white rounded-2xl shadow-md w-full max-w-screen-xl">
            <div id="piechart" class="mt-6 p-4"></div>

            <!-- กล่องปัญหา -->
            <div class="p-1">
                <div class="max-w-7xl h-32 bg-orange-500 rounded-lg p-4 mt-4 mx-auto flex justify-center items-center gap-6">
                    <h2 class="text-4xl font-semibold text-white">ปัญหาทั้งหมด</h2>
                    <p class="text-7xl font-semibold text-white">{{ $count }}</p>
                </div>

                <!-- 3 อันดับปัญหา -->
                <div id="topProblem" class="flex mx-auto mt-4 justify-center gap-5">
                    <div class="flex flex-col items-center">
                        <div id="pro1" class="flex size-24 bg-orange-300 rounded-lg justify-center items-center">
                            <p class="text-6xl text-white font-semibold">1</p>
                        </div>
                        <p class="text-center text-xl text-gray-700">-</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div id="pro2" class="flex size-24 bg-orange-400 rounded-lg justify-center items-center">
                            <p class="text-6xl text-white font-semibold">2</p>
                        </div>
                        <p class="text-center text-xl text-gray-700">-</p>
                    </div>
                    <div class="flex flex-col items-center">
                        <div id="pro3" class="flex size-24 bg-orange-500 rounded-lg justify-center items-center">
                            <p class="text-6xl text-white font-semibold">3</p>
                        </div>
                        <p class="text-center text-xl text-gray-700">-</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script type="text/javascript">
    // กำหนดช่วงวันที่
    function getFormattedMonth() {
        const currentDate = new Date();
        const currentMonth = currentDate.toLocaleString('default', { month: 'short' });
        const currentYear = currentDate.getFullYear();
        const firstDay = new Date(currentYear, currentDate.getMonth(), 1);
        const lastDay = new Date(currentYear, currentDate.getMonth() + 1, 0);
        return `From ${firstDay.getDate()}-${lastDay.getDate()} ${currentMonth}, ${currentYear}`;
    }

    document.getElementById('current-month').innerText = getFormattedMonth();

    axios.get("/dashboard-data").then(response => {
        const rawData = response.data;

        // สร้าง Pie chart
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(() => {
            const data = [['Tag Name', 'Count']];
            rawData.forEach(item => {
                data.push([item.problem, parseInt(item.population)]);
            });

            const options = {
                chartArea: { top: 0, height: '80%', width: '100%' },
                pieHole: 0.6,
                height: 300,
                legend: { position: 'bottom' },
                tooltip: { showColorCode: true },
                sliceVisibilityThreshold: 0.0001,
            };

            const chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(google.visualization.arrayToDataTable(data), options);
        });

        // แสดงข้อมูล 3 อันดับแรก
        rawData.forEach((item, index) => {
            if (index < 3) {
                const rank = index + 1;
                document.querySelector(`#pro${rank} p`).innerText = item.population;
                document.querySelector(`#pro${rank}`).nextElementSibling.innerText = item.problem;
            }
        });
    });
</script>
@endsection