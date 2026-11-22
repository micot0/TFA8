
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel POS - Login</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            margin: 0;
            font-family: 'Figtree', Arial, sans-serif;
            background-color: #f1f5f9;
            color: #162e4e;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px 16px;
        }

        .login-container {
            width: 100%;
            max-width: 450px;
        }

        .login-card {
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        .login-card input:not([type="checkbox"]) {
            width: 100%;
            box-sizing: border-box;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 10px 12px;
        }

        .login-card input:focus {
            outline: none;
            border-color: #162e4e;
            box-shadow: 0 0 0 2px rgba(22, 46, 78, 0.12);
        }

        .login-card button[type="submit"] {
            background-color: #162e4e;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .login-card button[type="submit"]:hover {
            background-color: #24466e;
        }

        .login-card a {
            color: #162e4e;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 24px;
        }

        .login-logo a {
            color: #162e4e;
            text-decoration: none;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="login-page">
        <div class="login-container">

            <div class="login-logo">
                <a href="/">
                    <x-application-logo class="w-16 h-16 mx-auto fill-current text-gray-500" />
                    <h2>Laravel POS</h2>
                    <p>Point of Sale Management System</p>
                </a>
            </div>

            <div class="login-card">
                {{ $slot }}
            </div>

            <div class="login-footer">
                &copy; {{ date('Y') }} Laravel POS. All rights reserved.
            </div>

        </div>
    </div>
</body>
</html>
