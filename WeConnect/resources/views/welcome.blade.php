<!DOCTYPE html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeConnect Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <title>WeConnect Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
            text-align: left;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #ffffff;
        }
        .logo {
            margin-bottom: 10px;
            width: 15px;
            height: auto;
            text-align: left;
        }

        h1 {
            color: #ff9800;
            font-size: 24px;
            text-align: right;
        }

        p {
            color: #ff9800;
            margin-bottom: 20px;
            text-align: right;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .login-btn {
            width: 50%;
            padding: 10px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            align-content: center;
            display: block;
            margin: 0 auto;
            text-align:center;
        }

        .login-btn:hover {
            background: #218838;
        }

        .box {
            width: 300px;
            height: 200px;
            background: linear-gradient(to bottom, #ff9800 100%);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="https://cdn.discordapp.com/attachments/1341429727180754974/1349635754929815573/image.png?ex=67d3d1be&is=67d2803e&hm=b541fa5e6a066a25f77b4f904883f079049d09f292153e3aef634f4c980d6824&"
                alt="WeConnect Logo" style="max-width: 100px; height: auto;">
        </div>
        <h1 class="fw-bold text-warning m-0">WeConnect</h1>
        <p>“Connect minds,
            change communities”</p>
        <form>
            <div class="row align-items-center">

                <label for="inputemail" class="form-label">Email</label>
                <input type="email" class="form-control" id="email">

            </div>

            <div class="row align-items-center">

                    <label for="inputPassword" class="col-form-label">Password</label>
                    <input type="password" id="inputPassword" class="form-control"
                        aria-describedby="passwordHelpInline">

                </div>
                <div class="text-center">
                    <button type="submit" class="login-btn">Login</button>
                </div>
        </form>
    </div>
</body>

</html>
