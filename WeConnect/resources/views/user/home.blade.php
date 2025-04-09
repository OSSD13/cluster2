@extends('layouts.layout_user')

@section('content')
<div class="fixed top-0 left-0 right-0 z-10">
    <div class="flex justify-between items-center px-6 mt-20 py-2">
        <h1 class="text-2xl font-semibold">Home</h1>
        <form action="{{ route('home.search') }}" method="GET" class="flex items-center" onsubmit="return checkSearch()">
            <input type="text" name="tag" placeholder="🔍 ค้นหาจากประเภทปัญหา" class="border px-3 py-1 rounded w-60" id="tagInput" />
            <button type="submit" class="ml-2 bg-blue-500 text-white px-4 py-2 rounded">
                ค้นหา
            </button>
        </form>

        <script>
            function checkSearch() {
                var tagValue = document.getElementById('tagInput').value;
                if (tagValue.trim() === "") {
                    // ถ้าไม่กรอกอะไรเลย ให้ redirect ไปที่หน้า Home ปกติ
                    window.location.href = "{{ url('home') }}";
                    return false; // ป้องกันการส่งฟอร์ม
                }
                return true; // ส่งฟอร์มหากกรอกข้อมูล
            }
        </script>
    </div>
</div>



<div id="problem-section" class="max-w-3xl mx-auto px-4 mt-6 space-y-4">
    @foreach($problems as $problem)
    <a href="{{ url('/problemdetail', $problem->prob_id) }}" class="block">
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
                <span class="bg-gray-200 px-2 py-1 rounded">
                    {{ $problem->tag->tag_name ?? '-' }}
                </span>
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

@endsection