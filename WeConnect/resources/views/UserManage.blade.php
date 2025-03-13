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
        <h2 class="font-bold text-6xl">User Manage</h2>
        <p class="text-2xl mb-4">เพิ่มผู้ใช้งาน</p>

        <form class="space-y-3">
            <h3>ชื่อผู้ใช้</h3>
            <input type="text" placeholder="" class="w-full p-2 border rounded-md">
            <h3>อีเมล</h3>
            <input type="email" placeholder="" class="w-full p-2 border rounded-md">

            <h3>ตำแหน่ง</h3>
            <select class="w-full p-2 border rounded-md w-xs">
                <option>User</option>
                <option>Manager</option>
                <option>Admin</option>
            </select>
            <h3>วันที่เพิ่มข้อมูล</h3>
            <input type="date" class="w-full p-2 border rounded-md">

            <button class="w-full bg-green-500 text-white p-2 rounded-md">เพิ่มผู้ใช้</button>
        </form>
    </div>

    <!-- Table -->
    <div class="max-w-lg mx-auto bg-white p-4 mt-6 rounded-lg shadow-md">
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">ผู้ใช้งาน</th>
                    <th class="p-2 border">ตำแหน่ง</th>
                    <th class="p-2 border">การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="p-2 border">Pawana Namaste</td>
                    <td class="p-2 border">User</td>
                    <td class="p-2 border text-center">
                        <button class="text-red-500">🗑️</button>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">Mario Balotelli</td>
                    <td class="p-2 border">Manager</td>
                    <td class="p-2 border text-center">
                        <button class="text-red-500">🗑️</button>
                    </td>
                </tr>
                <tr>
                    <td class="p-2 border">Cistopher Columbia</td>
                    <td class="p-2 border">Admin</td>
                    <td class="p-2 border text-center">
                        <button class="text-red-500">🗑️</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
