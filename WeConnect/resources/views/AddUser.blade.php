<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Manage</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>

</style>
<body class="bg-gray-100 p-4">

    <header class="bg-orange-500 p-4 flex items-center">
        <button class="text-white text-2xl mr-4">☰</button>
        <h1 class="text-white font-bold text-xl">WeConnect</h1>
    </header>


    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md mt-6">
        <img src="image.png" alt="UserIcon">
        <h2 class="font-bold text-3xl ">User Manage </h2>

        <p class="text-2xl mb-4">เพิ่มผู้ใช้งาน</p>

        <form class="space-y-3" action="{{ url('/adduser') }}" onsubmit="return addUser()" method="post">
            @csrf

            <h3>ชื่อผู้ใช้</h3>
            <input type="text" name="name" placeholder="" class="w-full p-2 border rounded-md">
            <h3>อีเมล</h3>
            <input type="email" name="email" placeholder="" class="w-full p-2 border rounded-md">

            <h3>ตำแหน่ง</h3>
            <select name="role" class="w-full p-2 border rounded-md w-xs">
                <option>User</option>
                <option>Manager</option>
                <option>Admin</option>
            </select>
            <h3>วันที่เพิ่มข้อมูล</h3>
            <input name="date" type="date" class="w-full p-2 border rounded-md">

            <button class="w-full bg-green-500 text-white p-2 ">เพิ่มผู้ใช้</button>
        </form>
    </div>



</body>
</html>