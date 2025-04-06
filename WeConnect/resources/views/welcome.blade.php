@extends('layouts.managermenu')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-2">Data Analytics</h1>
    <p class="text-gray-500 mb-6">ข้อมูลจังหวัด ---- อำเภอ ---- ตำบล ----</p>

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
        // กำหนดให้ไม่มีข้อมูล
        const chartData = {
            labels: ['อื่นๆ', 'ประปา', 'ไฟฟ้า'],
            values: [56, 30, 14]
        };

        const tableData = [
            { category: 'ไฟฟ้า', percentage: 14 },
            { category: 'ประปา', percentage: 30 },
            { category: 'อื่นๆ', percentage: 56 }
        ];

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        const hasData = chartData.values.length > 0 && chartData.values.some(value => value > 0);

        // แสดงกราฟหรือข้อความ "ไม่มีข้อมูลในระบบ"
        const pieChartCanvas = document.getElementById('pieChart');
        const noDataMessage = document.getElementById('noDataMessage');

        if (hasData) {
            // แสดงกราฟวงกลม
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
                            'rgba(255, 182, 193, 0.7)',
                            'rgba(173, 216, 230, 0.7)',
                            'rgba(255, 255, 153, 0.7)'
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
        } else {
            // แสดงข้อความไม่มีข้อมูล
            pieChartCanvas.classList.add('hidden');
            noDataMessage.classList.remove('hidden');
        }

        // แสดงข้อมูลตารางหรือข้อความ "ไม่มีข้อมูลในระบบ"
        const tableDataElement = document.getElementById('tableData');
        const noTableDataMessage = document.getElementById('noTableDataMessage');

        if (tableData.length > 0) {
            tableDataElement.classList.remove('hidden');
            noTableDataMessage.classList.add('hidden');
        } else {
            tableDataElement.classList.add('hidden');
            noTableDataMessage.classList.remove('hidden');
        }
    });
</script>
@endsection
