<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeConnect Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(to bottom right, #ff9800, #ffa726);
        }
        .container {
            background: white;
            width: 350px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        .logo {
            margin-bottom: 10px;
        }
        .logo img {
            width: 50px;
        }
        h1 {
            color: #ff9800;
            font-size: 24px;
        }
        p {
            color: #666;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .login-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="https://raw.githubusercontent.com/Namtan26/Image/main/Logo_WeConnect (2).jpg" alt="WeConnect Logo">
        </div>
        <h1>WeConnect</h1>
        <p>“Connect minds, change communities”</p>
        <form>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>

            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">Password</label>
                </div>
                <div class="col-auto">
                    <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                </div>
            <button type="submit" class="login-btn">Login</button>
        </form>
    </div>
</body>
</html>

