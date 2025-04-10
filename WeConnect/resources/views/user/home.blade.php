@extends('layouts.layout')


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
    <style>
        /* ตัดคำให้แสดงแค่ 3 บรรทัด */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            /* แสดงแค่ 3 บรรทัด */
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            /* เพิ่ม ... */
        }
    </style>
</head>

<body class="bg-gray-100 overflow-y-auto">
    <!-- แถบด้านบนที่เลื่อนตามหน้าจอและทับพื้นหลังสีเทา -->
    <div class="fixed top-0 left-0 right-0 bg-white shadow-md z-10 w-full">
        <div class="flex justify-between items-center px-6 py-2 mt-16">
            <h1 class="text-2xl font-semibold">Home</h1>
            <div class="relative"> <!-- ครอบ input และ suggestion box -->
                <form action="{{ route('home.search') }}" method="GET" class="flex items-center" onsubmit="return checkSearch()">
                    <input type="text" name="tag" placeholder="🔍 ค้นหาจากประเภทปัญหา" class="border px-4 py-2 w-90 rounded-l text-sm" id="tagInput" autocomplete="off" />
                    <ul id="tagSuggestions" class="absolute top-[48px] bg-white border rounded shadow w-72 z-50 hidden"></ul>
            </div>
            {{-- <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r">
                        ค้นหา
                    </button> --}}
        </div>
        </form>
    </div>
    </div>

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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('tagInput');
            const suggestionBox = document.getElementById('tagSuggestions');
            const form = input.closest('form'); // ✅ หา form ที่ครอบ input

            input.addEventListener('input', function() {
                const query = input.value;

                if (query.length > 0) {
                    fetch(`/autocomplete-tags?query=${query}`)
                        .then(response => response.json())
                        .then(data => {
                            suggestionBox.innerHTML = '';
                            data.forEach(tag => {
                                const li = document.createElement('li');
                                li.textContent = tag.tag_name;
                                li.className = 'px-4 py-2 hover:bg-gray-200 cursor-pointer';
                                li.addEventListener('click', () => {
                                    input.value = tag.tag_name; // ✅ ใส่ชื่อแท็กลง input
                                    suggestionBox.classList.add('hidden'); // ✅ ซ่อนกล่อง
                                    form.submit(); // ✅ ส่งฟอร์มอัตโนมัติ
                                });
                                suggestionBox.appendChild(li);
                            });
                            suggestionBox.classList.remove('hidden');
                        });
                } else {
                    suggestionBox.classList.add('hidden');
                }
            });

            document.addEventListener('click', function(e) {
                if (!suggestionBox.contains(e.target) && e.target !== input) {
                    suggestionBox.classList.add('hidden');
                }
            });
        });
    </script>


    </div>
    </div>

    <!-- เนื้อหาหลักที่เริ่มจากด้านล่างของแถบ -->
    <div class="pt-20 px-4">
        <div id="problem-section" class="max-w-3xl mx-auto space-y-4">
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
                        @foreach($problem->tags as $tag)
                        <span class="bg-gray-200 px-2 py-1 rounded inline-block mr-1 mb-1">
                            {{ $tag->tag_name }}
                        </span>
                        @endforeach
                    </p>
                    <p class="mt-1 line-clamp-3">{{ $problem->detail }}</p> <!-- ตัดคำ -->
                </div>
            </a>
            @endforeach
        </div>
    </div>

    <!-- ปุ่ม เพิ่มข้อมูล -->
    <div class="fixed bottom-6 right-6">
        <a onclick=clearLocalStorage() href="{{ url('addproblem') }}" class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">

            เพิ่มข้อมูล
        </a>
    </div>

    <script>
    function clearLocalStorage() {
            localStorage.clear();
        }
    </script>
</body>

</html>
@endsection

