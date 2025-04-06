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
    body{
        font-family: 'Kanit' , sans-serif;
    }

</style>
<body>
    <header class="fixed w-full bg-orange-500 p-4 flex items-center">
        <button id="menu-btn" class="text-white text-2xl mr-2 ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
        </button>
        <h1 class="text-white text-2xl ml-2">WeConnect</h1>
    </header>

    <!-- Sidebar -->
    <div id="sidebar" class="fixed top-16 w-64 h-full bg-gray-100 transform -translate-x-full transition-transform duration-300 z-30">
        <div class="p-4 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
            </svg>
            <div class="ml-3">
                <p class="font-medium">K. Udomsak</p>
                <p class="text-gray-500 text-sm">K.udomsak@gmail.com</p>
            </div>
        </div>
        <!-- Menu Items -->
        <nav class="p-4">
            <ul>
                <li class="mb-2">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                        <span class="mr-2">👤</span> User Manage
                    </a>
                </li>
            </ul>
        </nav>
        <div class="border h-px w-5/6 ml-4 border-black">
            <hr class="mb-4 flex  justify-between " />
            <button class="w-36 ml-8 flex items-center justify-center p-2 text-red-500 border border-red-500 rounded hover:bg-red-500 hover:text-white transition">
                <span class="mr-2">↩</span> Logout
            </button>
        </div>

    </div>

    <div class="">
        <iframe class="w-full h-screen pt-16"
            src="https://www.openstreetmap.org/export/embed.html?bbox=100.91890811920167%2C13.282948680839437%2C100.93223333358765%2C13.289798411948283&amp;layer=mapnik"
            style="border: 1px solid black">
        </iframe>
    </div>

    <!-- Fixed accordion box for position -->
    <div class="fixed bottom-0 right-0 w-full max-w-xs mx-auto p-4 rounded-2xl z-40">
        <div id="accordionBtn" class="flex justify-between p-2 rounded-t-2xl cursor-pointer shadow-lg bg-white">
            <span class="font-bold text-lg">ตำแหน่ง</span>
            <span id="arrow" class="w-8 h-8 flex items-center justify-center transition-transform rounded-full bg-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M11.47 7.72a.75.75 0 0 1 1.06 0l7.5 7.5a.75.75 0 1 1-1.06 1.06L12 9.31l-6.97 6.97a.75.75 0 0 1-1.06-1.06l7.5-7.5Z" clip-rule="evenodd" />
                </svg>
            </span>
        </div>

        <div id="accordionContent" class="max-h-0 overflow-hidden transition-all duration-300 bg-white rounded-b-2xl shadow-lg">
            <div class="p-3">
                <p class="text-gray-700 flex">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2">
                        <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                    </svg>
                    ที่อยู่
                </p>
                <p class="flex text-gray-700 mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2">
                        <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                    ปัญหาααα
                </p>
                <p class="flex text-gray-700 mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2">
                        <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                        <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                    </svg>
                    วันที่เพิ่ม
                </p>
            </div>
        </div>
    </div>

<script>
    const btn = document.getElementById("accordionBtn");
    const content = document.getElementById("accordionContent");
    const arrow = document.getElementById("arrow");

    btn.addEventListener("click", function() {
        content.classList.toggle("max-h-60");
        content.classList.toggle("overflow-hidden");
        arrow.classList.toggle("rotate-180");
    });

    const menuBtn = document.getElementById("menu-btn");
    const sidebar = document.getElementById("sidebar");

    menuBtn.addEventListener("click", function () {
        sidebar.classList.toggle("-translate-x-full");
        if (!sidebar.classList.contains("-translate-x-full")) {
            btn.style.display = "none";
        } else {
            btn.style.display = "flex";
        }
    });
</script>
</body>
</html>
