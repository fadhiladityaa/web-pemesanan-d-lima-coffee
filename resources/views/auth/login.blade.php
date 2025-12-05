<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - D'Lima Coffee</title>
    
    <!-- CSRF Token untuk AJAX (optional) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #b97a53;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            position: relative;
        }

        /* Lingkaran besar background */
        body::before {
            content: "";
            position: absolute;
            width: 800px;
            height: 800px;
            background: rgba(255, 255, 255, 0.20);
            border-radius: 50%;
            z-index: 1;
        }

         body::after {
            content: "";
            position: absolute;
            width: 980px;
            height: 980px;
            background: rgba(255, 255, 255, 0.20);
            border-radius: 50%;
            z-index: 1;
        }

        .container {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .logo img {
            width: 90px;
            margin-bottom: 5px;
        }

        .login-box {
            background: #f7e7d9;
            width: 420px;
            padding: 35px 40px;
            border-radius: 15px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.15);
            margin-top: 10px;
        }

        .login-box h2 {
            margin: 0 0 5px 0;
            font-size: 26px;
            font-weight: bold;
            color: #3b2416;
        }

        .login-box p {
            margin: 0 0 25px 0;
            color: #6e4b31;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: none;
            outline: none;
            background: #fff;
            border-radius: 20px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .forgot {
            text-align: right;
            margin-bottom: 15px;
        }

        .forgot a {
            font-size: 12px;
            color: #3b2416;
            text-decoration: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #8a532b;
            color: white;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: 15px;
            font-weight: bold;
        }

        button:hover {
            background: #6d4223;
        }
        
        /* Tambahan untuk error message */
        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-bottom: 10px;
            padding: 8px;
            background: #f8d7da;
            border-radius: 5px;
            display: none; /* Sembunyikan dulu */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="logo">
            <img src="{{ asset('img/Logo-Dlima-Coffe.png') }}" alt="Logo D'Lima Coffee">
            <h3 style="color:#2a1a10; margin-top:0;">D'Lima Coffee</h3>
        </div>

        <div class="login-box">
            <h2>Welcome Back</h2>
            <p>Log in to access your account.</p>
            
            <!-- Error Message -->
            @if(session('LoginError'))
                <div class="error-message" style="display: block;">
                    {{ session('LoginError') }}
                </div>
            @endif
            
            <!-- FORM YANG DIPERBAIKI -->
            <form method="POST" action="{{ route('login') }}">
                @csrf <!-- INI WAJIB! -->
                
                <!-- Perhatikan: Controller mengharapkan 'noHp', bukan 'email' -->
                <input type="text" name="noHp" placeholder="Nomor HP" required>
                
                <input type="password" name="password" placeholder="Password" required>

                <div class="forgot">
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

</body>
</html>