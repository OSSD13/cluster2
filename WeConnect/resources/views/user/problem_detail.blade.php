@extends('layouts.layout_user')

@section('content')
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeConnect - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-gray-100">

    <div class="flex justify-between items-center px-6 mt-4">
        <h1 class="text-2xl font-semibold">Home</h1>
        <input type="text" placeholder="🔍 ค้นหา" class="border px-3 py-1 rounded w-60" />
    </div>

    <div id="problem-section" class="max-w-3xl mx-auto px-4 mt-6 space-y-4">
        @foreach($problems as $problem)
        <a href="{{ route('problemdetail', ['id' => $problem->prob_id]) }}" class="block">
            <div class="bg-white p-4 rounded-xl shadow">
                <p class="text-sm text-gray-500">
                    {{ \Carbon\Carbon::parse($problem->created_at)->format('d/m/Y H:i') }}
                </p>
                <p class="font-semibold mt-1">เพิ่มโดย : นายxxx xxxxxx</p>
                <p class="mt-1">
                    📍 <strong>สถานที่</strong> : {{ $problem->community_name }}
                    ตำบล {{ $problem->sub_district }}
                    อำเภอ {{ $problem->district }}
                    จังหวัด {{ $problem->province }}
                    {{ $problem->post_code }}
                </p>
                <p class="mt-1">
                    ⚠️ <strong>ปัญหา</strong> :
                    <span class="bg-gray-200 px-2 py-1 rounded">ไฟฟ้า</span>
                </p>
                <p class="mt-1">{{ $problem->detail }}</p>
            </div>
        </a>
        @endforeach
    </div>
    <!-- ปุ่ม เพิ่มข้อมูล -->
    <div class="fixed bottom-6 right-6">
        <a href="{{ url('addproblem') }}" class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
            เพิ่มข้อมูล
        </a>
    </div>

</body>
</html>
@endsection
