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

    <div class="mt-6 bg-white max-w-lg p-6 rounded-lg mx-auto">
            <h2 class="font-bold  text-3xl">เพิ่มข้อมูล</h2>
            <form class="space-y-3">
                <h3>ชื่อของชุมชน</h3>
                <input type="text" class="w-full p-2 border rounded-md">
                <h3>ที่อยู่</h3>
                <input type="text" class="w-full p-2 border rounded-md">
                <h3>ปัญหาที่พบ</h3>
                <input type="text" class="w-full p-2 border rounded-md">
                <h3>คำอธิบายเพิ่มเติม</h3>
                <textarea class="p-2 border border-gray-300 rounded-lg w-full max-w-lg  focus:border-transparent" rows="5" placeholder="Enter your text here..."></textarea>
                <h3>แนบรูปเพิ่มเติม</h3>
                <input type="file">
                <button type="submit" class="bg-lime-300 rounded-lg size-auto" >ยืนยันข้อมูล</button>
            </form>
    </div>
</body>
</html>
