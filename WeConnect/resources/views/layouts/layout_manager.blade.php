<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeConnect</title>
    <link rel="icon" type="image/x-icon" href="https://github.com/AudomsakalcoholicBoy/images/blob/main/LogoWeConnect.png?raw=true">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }

        .menu {
            margin-left: 10px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 30;
        }

        .overlay.active {
            display: block;
        }

        html,
        body {
            height: 100%;
            overflow: hidden;
            margin: 0;
            padding: 0;
        }

        main {
            height: calc(100vh - 4rem);
            overflow-y: auto;
        }
    </style>

    @yield('styles')
</head>

<body>
    <header class="bg-orange-500 p-4 flex items-center z-50 relative">
        <button id="menu-btn" class="text-white text-2xl mr-2 ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8">
                <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
            </svg>
        </button>
        <h1 class="text-white text-2xl ml-2">WeConnect</h1>
    </header>

    <div id="overlay" class="overlay"></div>

    <div id="sidebar" class="fixed top-16 w-64 h-[calc(100%-4rem)] bg-gray-100 transform -translate-x-full transition-transform duration-300 z-40 flex flex-col">
        <div class="p-4 flex items-center border-b">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 shrink-0 flex-none">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
            </svg>
            <div class="ml-3">
                <p class="font-medium">Username</p>
                <p class="text-gray-500 text-sm">Email</p>
            </div>
        </div>

        <!-- Menu Items -->
        <nav class="p-4 flex-grow">
            <ul>
                <li class="mb-2">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M3 6a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v12a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm4.5 7.5a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-1.5 0v-2.25a.75.75 0 0 1 .75-.75Zm3.75-1.5a.75.75 0 0 0-1.5 0v4.5a.75.75 0 0 0 1.5 0V12Zm2.25-3a.75.75 0 0 1 .75.75v6.75a.75.75 0 0 1-1.5 0V9.75A.75.75 0 0 1 13.5 9Zm3.75-1.5a.75.75 0 0 0-1.5 0v9a.75.75 0 0 0 1.5 0v-9Z" clip-rule="evenodd" />
                        </svg>
                        <span class="menu">Dashboard</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M2.25 13.5a8.25 8.25 0 0 1 8.25-8.25.75.75 0 0 1 .75.75v6.75H18a.75.75 0 0 1 .75.75 8.25 8.25 0 0 1-16.5 0Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M12.75 3a.75.75 0 0 1 .75-.75 8.25 8.25 0 0 1 8.25 8.25.75.75 0 0 1-.75.75h-7.5a.75.75 0 0 1-.75-.75V3Z" clip-rule="evenodd" />
                        </svg>
                        <span class="menu">Data Analytics</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="p-4 border-t">
            <a href="#" class="flex items-center p-2 text-gray-700 hover:bg-gray-200 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M16.5 3.75a1.5 1.5 0 0 1 1.5 1.5v13.5a1.5 1.5 0 0 1-1.5 1.5h-6a1.5 1.5 0 0 1-1.5-1.5V15a.75.75 0 0 0-1.5 0v3.75a3 3 0 0 0 3 3h6a3 3 0 0 0 3-3V5.25a3 3 0 0 0-3-3h-6a3 3 0 0 0-3 3V9A.75.75 0 1 0 9 9V5.25a1.5 1.5 0 0 1 1.5-1.5h6ZM5.78 8.47a.75.75 0 0 0-1.06 0l-3 3a.75.75 0 0 0 0 1.06l3 3a.75.75 0 0 0 1.06-1.06l-1.72-1.72H15a.75.75 0 0 0 0-1.5H4.06l1.72-1.72a.75.75 0 0 0 0-1.06Z" clip-rule="evenodd" />
                </svg>
                <span class="menu logout">Logout</span>
            </a>
        </div>
    </div>

    <main class="pt-4">
        @yield('content')
    </main>

    <script>
        const menuBtn = document.getElementById("menu-btn");
        const sidebar = document.getElementById("sidebar");
        const overlay = document.getElementById("overlay");

        menuBtn.addEventListener("click", function() {
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("active");
        });

        overlay.addEventListener("click", function() {
            sidebar.classList.add("-translate-x-full");
            overlay.classList.remove("active");
        });
    </script>

    @yield('scripts')
</body>

</html>
