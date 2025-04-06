<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Manage</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            background: rgb(255, 127, 39);;
            padding: 10px;
            color: white;
        }

        /* Sidebar Style */
        .sidebar {
            width: 250px;
            position: fixed;
            left: -250px;
            top: 0;
            height: 100%;
            background: #fff;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
            transition: left 0.3s ease;
            z-index: 1000;
        }

        .sidebar.open {
            left: 0;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
        }

        .overlay.active {
            display: block;
        }

        .sidebar-header {
            padding: 20px;
            background: rgb(255, 127, 39);
            color: white;
        }

        .menu-item {
            padding: 15px 20px;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
        }

        .logout {
            position: absolute;
            bottom: 20px;
            width: 100%;
        }
    </style>
</head>

<body class="bg-gray-100 p-4">

    <!-- Navbar -->
    <header class="bg-orange-500 p-4 flex items-center">
        <button class="text-white text-2xl mr-4" id="toggleSidebar">☰</button>
        <h1 class="text-white font-bold text-xl">WeConnect</h1>
    </header>

    <!-- Content -->
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

            <button class="w-full bg-green-500 text-white p-2">เพิ่มผู้ใช้</button>
        </form>
    </div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <p><strong>K. Udomsak</strong></p>
        <p>K.udomsak@gmail.com</p>

        </div>
        <div class="menu-item">👤 User Manage</div>
        <div class="menu-item logout">🔓 Logout</div>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- JavaScript -->
    <script>
        $(document).ready(function () {
            // เปิด-ปิด Sidebar
            $('#toggleSidebar').click(function () {
                $('#sidebar').toggleClass('open');
                $('#overlay').toggleClass('active');
            });

            // คลิกที่ Overlay เพื่อปิด Sidebar
            $('#overlay').click(function () {
                $('#sidebar').removeClass('open');
                $('#overlay').removeClass('active');
            });
        });
    </script>

</body>

</html>
