<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Outfit:wght@100..900&display=swap"
        rel="stylesheet">
    <title>WeConnect Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100vw;
            height: 100vh;
            background-color: #ffffff;
            font-family: Arial, sans-serif;
            overflow: hidden;
            position: relative;
        }

        .container {
            width: 90vw;
            max-width: 400px;
            padding: 20px;
            text-align: center;
            z-index: 1;
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding-bottom: 50px;
        }

        table {
            width: 100%;
            margin-bottom: 10px;
        }

        td {
            vertical-align: middle;
        }

        .logo img {
            width: 80px;
        }

        .text {
            margin-left: 10px;
            text-align: left;
        }

        .text h1 {
            font-size: 36px;
            color: #ff9800;
            font-weight: bold;
        }

        .text p {
            font-size: 20px;
            color: #ffab40;
        }

        form {
            text-align: left;
            width: 100%;
            margin-top: 20px;
        }

        label {
            display: block;
            font-size: 14px;
            color: #333;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-btn {
            display: block;
            margin: 20px auto;
            min-width: 150px;
            max-width: 300px;
            padding: 12px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-btn:hover {
            background: #218838;
        }

        .wave {
            position: absolute;
            left: 0;
            width: 100%;
            z-index: -1;
        }

        .wave-top {
            top: 0;
        }

        .wave-bottom {
            bottom: 0;
        }

        .wave-bottom-dark {
            bottom: 0;
            z-index: -2;
        }
    </style>
</head>

<body>
    <svg class="wave wave-top" viewBox="0 0 1440 320">
        <path fill="#ff9800" fill-opacity="1"
            d="M0,256L80,245.3C160,235,320,213,480,170.7C640,128,800,64,960,74.7C1120,85,1280,171,1360,213.3L1440,256L1440,0L1360,0C1280,0,1120,0,960,0C800,0,640,0,480,0C320,0,160,0,80,0L0,0Z">
        </path>
    </svg>

    <div class="container">
        <table>
            <tr>
                <td class="logo">
                    <img src="https://github.com/Namtan26/image/blob/main/image%2042.png?raw=true" alt="WeConnect Logo">
                </td>
                <td class="text">
                    <h1>WeConnect</h1>
                    <p>"Connect minds, change communities"</p>
                </td>
            </tr>
        </table>

        <form action="{{ url('/login') }}" onsubmit="return login()" method="post">
            @csrf

            <label>Email</label>
            <input type="email" name="email" placeholder="Email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Password" required>

            <button class="login-btn" type="submit">Login</button>
        </form>
    </div>

    <svg class="wave wave-bottom" viewBox="0 0 1440 320">
        <path fill="#ff9800" fill-opacity="1"
            d="M0,224L80,208C160,192,320,160,480,176C640,192,800,256,960,240C1120,224,1280,128,1360,80L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
        </path>
    </svg>
    <svg class="wave wave-bottom-dark" viewBox="0 0 1440 320">
        <path fill="#ffab40" fill-opacity="1"
            d="M0,32L80,32C160,32,320,32,480,80C640,128,800,224,960,229.3C1120,235,1280,149,1360,106.7L1440,64L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z">
        </path>
    </svg>
</body>

</html>
