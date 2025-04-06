<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>template</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
body {
    font-family: 'Kanit', sans-serif;
    background-color: #ffffff;
    margin: 0;
}

    .container {
    max-width: 400px;
    margin: 5px auto;
    background: white;
    padding: 20px;
    border-radius: 10px;
}

    .form-control {
    border-radius: 10px; /* เพิ่มความมนให้กับกล่องกรอกข้อความ */
    padding: 5px 10px; /* เพิ่ม อ้วน-ผอม ของกล่อง */
    border: 1px solid #ccc; /* ขอบเทา */
    width: 100%;
}
    .form-label.required::after {
        content: " *";
        color: red;
    }
</style>
<body>
    <!-- แถบด้านบน -->
    <header class="bg-orange-400 p-4 flex items-center">
        <button id="menu-btn" class="text-white text-2xl mr-2 ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
        </button>
        <h1 class="text-white text-2xl ml-2">WeConnect</h1>
    </header>

    <div class="container">
        <h2 class="text-black text-2xl font-semibold">เพิ่มบัญชีผู้ใช้</h2>
        <form >
            <div class="mb-3 mt-6">
                <label for="username" class="form-label required">ชื่อผู้ใช้</label>
                <input type="text" class="form-control" id="username" required >
            </div>
            <div class="mb-3">
                <label for="email" class="form-label required">อีเมล</label>
                <input type="email" class="form-control " id="email" required >
            </div>
            <div class="mb-3">
                <label for="password" class="form-label required">รหัสผ่าน</label>
                <input type="password" class="form-control" id="password"required >
            </div>
            <div class="mb-3">
                <label for="position" class="form-label required">ตำแหน่ง</label>
                <input type="text" class="form-control" id="position" required >
            </div>
            <div class="flex justify-center mt-6">
                <button class="bg-green-500 text-white px-8 py-3 rounded-full text-lg hover:bg-green-600">
                    ยืนยันข้อมูล
                </button>
            </div>
        </form>
    </div>
</body>
</html>
