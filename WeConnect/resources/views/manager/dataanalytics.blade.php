@extends ('layouts.layout_manager')

@section('content')
<div class="min-h-screen bg-white p-4">

    <!-- Title -->
    <h1 class="text-2xl font-bold mb-2">Data Analytics</h1>
    <p class="text-gray-600 mb-4">ข้อมูลจังหวัด ---- อำเภอ ---- ตำบล ----</p>

    <!-- Chart -->
    <div class="w-full max-w-xs mx-auto">
        <canvas id="problemChart"></canvas>
    </div>

    <!-- Info Box -->
    <div class="bg-gray-100 rounded-xl p-4 mt-6 max-w-xs mx-auto">
        <h2 class="font-bold mb-3">ปัญหาโดยเฉลี่ยที่ได้จากการสำรวจ</h2>
        <div class="flex justify-between">
            <span>ไฟฟ้า</span><span>14 %</span>
        </div>
        <div class="flex justify-between">
            <span>ประปา</span><span>30 %</span>
        </div>
        <div class="flex justify-between">
            <span>อื่นๆ</span><span>56 %</span>
        </div>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('problemChart').getContext('2d');
    const problemChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['ไฟฟ้า', 'ประปา', 'อื่นๆ'],
            datasets: [{
                data: [14, 30, 56],
                backgroundColor: ['#FFFF88', '#AEE5FF', '#FFC8C8'], // สีแบบในภาพ
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection
