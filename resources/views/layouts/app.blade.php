<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>KaryaLokal</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            margin: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #212529;
            color: white;
        }

        .sidebar h4 {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #444;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #adb5bd;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #343a40;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>

<div class="sidebar">
    <h4>KaryaLokal Merchant</h4>

    <a href="/merchant">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>

    <a href="/merchant/products">
        <i class="bi bi-box-seam"></i> Produk
    </a>

    <a href="/merchant/store">
        <i class="bi bi-shop"></i> Toko Saya
    </a>

    <form action="/logout" method="POST" class="px-3 mt-3">
        @csrf
        <button class="btn btn-danger w-100">
            <i class="bi bi-box-arrow-right"></i> Logout
        </button>
    </form>
</div>

<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>