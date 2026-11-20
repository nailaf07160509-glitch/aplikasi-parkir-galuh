
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Parkir</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            color: #374151;
        }

        /* KOTAK LOGIN */
        .login-container {
            width: 100%;
            max-width: 390px;
            background: #ffffff;
            padding: 35px;
            border: 1px solid #e5e7eb;
            border-radius: 9px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 8px;
            color: #343b46;
            font-size: 23px;
            font-weight: 600;
        }

        .login-subtitle {
            text-align: center;
            color: #89919c;
            font-size: 13px;
            margin-bottom: 28px;
        }

        /* FORM */
        .form-group {
            margin-bottom: 17px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #4b5563;
            margin-bottom: 7px;
        }

        .form-group input {
            width: 100%;
            padding: 11px 12px;
            border: 1px solid #d8dce2;
            border-radius: 5px;
            font-size: 13px;
            outline: none;
            background: #ffffff;
        }

        .form-group input:focus {
            border-color: #8794a5;
        }

        /* TOMBOL LOGIN */
        .btn-login {
            width: 100%;
            padding: 11px;
            background: #596779;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 5px;
        }

        .btn-login:hover {
            background: #424f60;
        }

        /* PESAN ERROR */
        .alert-error {
            background: #faf1f1;
            border: 1px solid #efdada;
            color: #b45353;
            padding: 10px;
            border-radius: 5px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        @media (max-width: 480px) {
            .login-container {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

    <div class="login-container">

        <h2 class="login-title">Aplikasi Parkir</h2>
        <p class="login-subtitle">Silakan login untuk melanjutkan</p>

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div class="form-group">
                <label>Username</label>
                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label>Password</label>
                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>
        </form>

    </div>

</body>
</html>
