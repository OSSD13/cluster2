@extends('layouts.layout')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-2">Data Analytics</h1>

    <div id="locationInfo" class="mb-6">
        <p id="locationText" class="text-gray-500">กำลังโหลดข้อมูลพื้นที่...</p>
    </div>

    <div class="bg-white rounded-lg shadow-md p-4 mb-6">
        <div class="w-full" style="height: 300px;">
            <canvas id="pieChart" class="hidden"></canvas>
            <div id="noDataMessage" class="flex items-center justify-center h-full text-gray-500 text-xl font-medium">
                ไม่มีข้อมูลในระบบ
            </div>
        </div>
    </div>

    <div class="bg-gray-100 rounded-lg p-4">
        <h2 class="text-xl font-semibold mb-4">ปัญหาโดยเฉลี่ยที่ได้จากการสำรวจ</h2>
        <div id="tableData" class="hidden">
            <table class="w-full">
                <tr class="border-b">
                    <td class="py-2">ไฟฟ้า</td>
                    <td class="py-2 text-right">14 %</td>
                </tr>
                <tr class="border-b">
                    <td class="py-2">ประปา</td>
                    <td class="py-2 text-right">30 %</td>
                </tr>
                <tr>
                    <td class="py-2">อื่นๆ</td>
                    <td class="py-2 text-right">56 %</td>
                </tr>
            </table>
        </div>
        <div id="noTableDataMessage" class="text-center py-8 text-gray-500">
            ไม่มีข้อมูลในระบบ
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ดึงข้อมูลพื้นที่
        fetchLocationData();

        // ดึงข้อมูลกราฟและตาราง
        fetchAnalyticsData();
    });

    // ฟังก์ชันดึงข้อมูลพื้นที่ (จังหวัด อำเภอ ตำบล)
    function fetchLocationData() {
        const locationText = document.getElementById('locationText');

        // จำลองการเรียก API ด้วย fetch
        // ในการใช้งานจริง ให้เปลี่ยนเป็น URL ของ API จริง
        fetch('/api/current-location', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('ไม่สามารถดึงข้อมูลพื้นที่ได้');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.province && data.district && data.subdistrict) {
                locationText.innerHTML = `ข้อมูลจังหวัด ${data.province} อำเภอ ${data.district} ตำบล ${data.subdistrict}`;
            } else {
                locationText.innerHTML = 'ไม่พบข้อมูลพื้นที่';
            }
        })
        .catch(error => {
            console.error('Error fetching location data:', error);
            locationText.innerHTML = 'ไม่สามารถดึงข้อมูลพื้นที่ได้';
        });

        // MOCK DATA - ให้ลบส่วนนี้ออกเมื่อใช้งานจริงกับ API
        // สำหรับทดสอบเท่านั้น
        setTimeout(() => {
            // สร้างเงื่อนไขสุ่มว่าจะมีข้อมูลหรือไม่
            const hasMockData = false; // เปลี่ยนเป็น true เพื่อจำลองว่ามีข้อมูล

            if (hasMockData) {
                locationText.innerHTML = 'ข้อมูลจังหวัด เชียงใหม่ อำเภอ เมือง ตำบล สุเทพ';
            } else {
                locationText.innerHTML = 'ไม่พบข้อมูลพื้นที่';
            }
        }, 1000);
    }

    // ฟังก์ชันดึงข้อมูลกราฟและตาราง
    function fetchAnalyticsData() {
        const pieChartCanvas = document.getElementById('pieChart');
        const noDataMessage = document.getElementById('noDataMessage');
        const tableDataElement = document.getElementById('tableData');
        const noTableDataMessage = document.getElementById('noTableDataMessage');

        // จำลองการเรียก API ด้วย fetch
        // ในการใช้งานจริง ให้เปลี่ยนเป็น URL ของ API จริง
        fetch('/api/analytics-data', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('ไม่สามารถดึงข้อมูลได้');
            }
            return response.json();
        })
        .then(data => {
            if (data && data.chartData && data.chartData.values && data.chartData.values.length > 0 &&
                data.tableData && data.tableData.length > 0) {

                // แสดงกราฟ
                renderChart(data.chartData);

                // แสดงตาราง
                renderTable(data.tableData);
            } else {
                // แสดงข้อความไม่มีข้อมูล
                pieChartCanvas.classList.add('hidden');
                noDataMessage.classList.remove('hidden');
                tableDataElement.classList.add('hidden');
                noTableDataMessage.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error fetching analytics data:', error);
            // แสดงข้อความไม่มีข้อมูล
            pieChartCanvas.classList.add('hidden');
            noDataMessage.classList.remove('hidden');
            tableDataElement.classList.add('hidden');
            noTableDataMessage.classList.remove('hidden');
        });

        // MOCK DATA - ให้ลบส่วนนี้ออกเมื่อใช้งานจริงกับ API
        // สำหรับทดสอบเท่านั้น
        setTimeout(() => {
            // สร้างเงื่อนไขสุ่มว่าจะมีข้อมูลหรือไม่
            const hasMockData = false; // เปลี่ยนเป็น true เพื่อจำลองว่ามีข้อมูล

            if (hasMockData) {
                // ข้อมูลจำลอง
                const mockData = {
                    chartData: {
                        labels: ['อื่นๆ', 'ประปา', 'ไฟฟ้า'],
                        values: [56, 30, 14]
                    },
                    tableData: [
                        { category: 'ไฟฟ้า', percentage: 14 },
                        { category: 'ประปา', percentage: 30 },
                        { category: 'อื่นๆ', percentage: 56 }
                    ]
                };

                // แสดงกราฟ
                renderChart(mockData.chartData);

                // แสดงตาราง
                renderTable(mockData.tableData);
            } else {
                // แสดงข้อความไม่มีข้อมูล
                pieChartCanvas.classList.add('hidden');
                noDataMessage.classList.remove('hidden');
                tableDataElement.classList.add('hidden');
                noTableDataMessage.classList.remove('hidden');
            }
        }, 1000);
    }

    // ฟังก์ชันสำหรับแสดงกราฟ
    function renderChart(chartData) {
        const pieChartCanvas = document.getElementById('pieChart');
        const noDataMessage = document.getElementById('noDataMessage');

        pieChartCanvas.classList.remove('hidden');
        noDataMessage.classList.add('hidden');

        const ctx = pieChartCanvas.getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: chartData.labels,
                datasets: [{
                    data: chartData.values,
                    backgroundColor: [
                        'rgba(255, 182, 193, 0.7)',  // สีชมพูอ่อน
                        'rgba(173, 216, 230, 0.7)',  // สีฟ้าอ่อน
                        'rgba(255, 255, 153, 0.7)'   // สีเหลืองอ่อน
                    ],
                    borderColor: [
                        'rgba(255, 182, 193, 1)',
                        'rgba(173, 216, 230, 1)',
                        'rgba(255, 255, 153, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                family: 'Kanit'
                            }
                        }
                    }
                }
            }
        });
    }

    // ฟังก์ชันสำหรับแสดงตาราง
    function renderTable(tableData) {
        const tableDataElement = document.getElementById('tableData');
        const noTableDataMessage = document.getElementById('noTableDataMessage');

        // สร้างตารางใหม่
        let tableHTML = '<table class="w-full">';

        tableData.forEach((item, index) => {
            const isLast = index === tableData.length - 1;
            tableHTML += `
                <tr class="${!isLast ? 'border-b' : ''}">
                    <td class="py-2">${item.category}</td>
                    <td class="py-2 text-right">${item.percentage} %</td>
                </tr>
            `;
        });

        tableHTML += '</table>';

        // แสดงตาราง
        tableDataElement.innerHTML = tableHTML;
        tableDataElement.classList.remove('hidden');
        noTableDataMessage.classList.add('hidden');
    }
</script>
@endsection
