<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            margin: 0;
            font-family: 'Georgia', serif;
            background: #0f172a;
            color: #fff;
        }

        .welcome-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            padding: 20px;
            position: relative;
            z-index: 1; /* penting */
        }

        .welcome-card {
            background: #1e293b;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.4);
            max-width: 600px;
            width: 100%;
            position: relative;
            z-index: 2; /* pastikan di atas */
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            margin: 5px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer; /* tambahan */
        }

        .btn-login {
            background: #facc15;
            color: #0f172a;
        }

        .btn-login:hover {
            background: #eab308;
        }

        .btn-register {
            background: transparent;
            border: 2px solid #facc15;
            color: #facc15;
        }

        .btn-register:hover {
            background: #facc15;
            color: #0f172a;
        }
    </style>
</head>

<body>

<div class="welcome-container">
    <div class="welcome-card">

        <h1>📚 Perpustakaan Digital</h1>

        <p>
            Selamat datang di sistem perpustakaan.<br>
            Silakan login untuk mengakses fitur peminjaman buku, data anggota, dan katalog buku.
        </p>

        <div>
            <a href="{{ route('login') }}" class="btn btn-login">Login</a>
            <a href="{{ route('register') }}" class="btn btn-register">Register</a>
        </div>

    </div>
</div>

</body>
</html>