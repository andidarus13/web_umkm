<!DOCTYPE html>
<html>
<head>
    <title>Login - KaryaLokal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #e11d48;
            --secondary: #16a34a;
            --dark: #111827;
        }

        body {
            background: linear-gradient(120deg, #e11d48, #16a34a);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .login-card {
            background: white;
            padding: 35px;
            border-radius: 15px;
            width: 380px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            animation: fadeUp 0.5s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            height: 70px;
        }

        .form-control {
            border-radius: 8px;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 5px rgba(225,29,72,0.5);
        }

        .btn-login {
            background: var(--primary);
            color: white;
            border-radius: 8px;
        }

        .btn-login:hover {
            background: #be123c;
        }

        .link {
            text-align: center;
            margin-top: 10px;
        }

        .link a {
            color: var(--primary);
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="login-card">

    <!-- LOGO -->
    <div class="logo">
        <img src="{{ asset('karyalokal.png') }}">
        <h5 class="mt-2 fw-bold" style="color:var(--primary)">KaryaLokal</h5>
    </div>

    <!-- ERROR -->
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- FORM -->
    <form method="POST" action="/login">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="d-grid">
            <button class="btn btn-login">Login</button>
        </div>

    </form>

    <!-- REGISTER -->
    <div class="link">
        Belum punya akun? <a href="/register">Daftar</a>
    </div>

</div>

</body>
</html>