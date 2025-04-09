<head>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>
    <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
</head>

<div class="bg-white min-h-screen font-sans">
    {{-- Header --}}
    <div class="bg-orange-500 text-white px-6 py-4 shadow-md flex items-center justify-between rounded-b-2xl">
        <div class="text-2xl font-bold">
            ☰ <span class="ml-2">WeConnect</span>
        </div>
    </div>

    {{-- Dashboard Title --}}
    <div class="mt-8 px-6">
        <h1 class="text-4xl font-bold mb-1">Dashboard</h1>
        <p class="text-gray-500 text-sm">From 1–31 Dec, 2020</p>
    </div>

    {{-- Donut Chart --}}
    <div class="flex flex-col items-center mt-8">
        {{-- You can replace this with real chart later --}}
        <div class="relative w-40 h-40">
            <div class="w-full h-full rounded-full border-[18px] border-orange-300 border-t-orange-500 rotate-[140deg]"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-20 h-20 bg-white rounded-full"></div>
        </div>

        {{-- Legend --}}
        <div class="flex justify-around w-full mt-6 px-6 text-sm text-gray-700">
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-orange-400 rounded-full"></div>
                <span>ไฟฟ้า 40%</span>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                <span>น้ำประปา 32%</span>
            </div>
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-orange-200 rounded-full"></div>
                <span>ถนน 28%</span>
            </div>
        </div>
    </div>

    {{-- Total Issues --}}
    <div class="bg-orange-400 text-white rounded-2xl mt-10 mx-6 py-6 text-center shadow-md">
        <p class="text-2xl font-semibold">ปัญหาทั้งหมด</p>
        <p class="text-6xl font-bold mt-2">14</p>
    </div>

    {{-- Issue Breakdown --}}
    <div class="grid grid-cols-3 gap-4 px-6 mt-8 text-white">
        <div class="bg-orange-200 p-5 rounded-2xl text-center shadow">
            <p class="text-3xl font-bold">3</p>
            <p class="text-black mt-1 text-sm">ไฟฟ้า</p>
        </div>
        <div class="bg-orange-300 p-5 rounded-2xl text-center shadow">
            <p class="text-3xl font-bold">6</p>
            <p class="text-black mt-1 text-sm">น้ำประปา</p>
        </div>
        <div class="bg-orange-400 p-5 rounded-2xl text-center shadow">
            <p class="text-3xl font-bold">5</p>
            <p class="text-black mt-1 text-sm">ถนน</p>
        </div>
    </div>
</div>
