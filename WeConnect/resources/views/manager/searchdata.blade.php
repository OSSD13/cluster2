@extends ('layouts.layout_manager')

@section('content')
<!DOCTYPE html>
<html lang="th">

<style>
  .custom-select {
    width: 250px;
    padding: 5px 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 10px;
    color: #888;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background: url("data:image/svg+xml;utf8,<svg fill='black' height='16' viewBox='0 0 24 24' width='16' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>") no-repeat right 12px center;
    background-color: white;
    background-size: 16px;
    text-align: center;
  }
</style>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>WeConnect - Dashboard</title>

    <!-- import javascript สร้าง  pie chart และ axios เพื่อดึงข้อมูลจาก MySQL แบบ ajax -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<body class="bg-gray-100">
    @section('content')
    <!-- เมนูซ่อน -->
    <div id="menu" class="hidden fixed top-15 left-0 h-full w-64 p-4 bg-white shadow-lg ">
        {{-- <div id="menu" class="hidden bg-white shadow-md absolute h-screen top-15 left-0 w-64 p-4"> --}}
        <ul class="space-y-2">
            <li><a href="#" class="block text-gray-700"> Home</a></li>
            <li><a href="#" class="block text-gray-700" onclick="openGoogleMaps()"> Map</a></li>
            <li><a href="#" class="block text-gray-700"> Form</a></li>
            <li><a href="#" class="block text-gray-700 pt-30"> Log out</a></li>
        </ul>
    </div>

    <!-- Data Analytics -->
    <h1 class="text-4xl font-semibold mt-4 text-left px-6">Data Analytics</h1>
    <div class="p-4">

    <h2 style="display: inline;">
        กรอกพื้นที่ที่ต้องการทราบข้อมูล
    </h2>
    <span style="font-size: 0.85em; color: gray;"> (เช่น จังหวัด อำเภอ ตำบล)</span>

    <div style="text-align: center; margin: 40px auto 0;">
    <select class="custom-select">
  <option selected disabled>เลือกจังหวัด</option>
  <!-- รายการอำเภอ -->
</select>
<br>

<div style="text-align: center; margin: 20px auto 0;">
<select class="custom-select">
  <option selected disabled>เลือกอำเภอ</option>
  <!-- รายการอำเภอ -->
</select>
<br>

<div style="text-align: center; margin: 20px auto 0;">
<select class="custom-select">
  <option selected disabled>เลือกตำบล</option>
  <!-- รายการอำเภอ -->
</select>
<br>


<div class="flex justify-center mt-6">
            <button class="bg-green-500 text-white px-6 py-2 rounded-full text-lg shadow-md hover:bg-green-600">
                 ค้นหา
            </button>
        </div>


    </body>
    </html>
    @endsection
