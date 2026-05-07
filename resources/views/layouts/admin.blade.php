<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- CHART -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { margin: 0; }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #111827;
            color: white;
        }

        .sidebar h4 {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #333;
        }

        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #9ca3af;
            text-decoration: none;
        }

        .sidebar a:hover {
            background: #1f2937;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h4>ADMIN</h4>

    <a href="/admin"><i class="bi bi-speedometer2"></i> Dashboard</a>

    <a href="/admin/users"><i class="bi bi-people"></i> Users</a>

    <a href="/admin/merchants"><i class="bi bi-shop"></i> Merchant</a>

    <a href="/admin/categories">
    <i class="bi bi-tags"></i> Kategori
</a>

    <!-- DROPDOWN LAPORAN -->
    <a data-bs-toggle="collapse" href="#laporanMenu">
        <i class="bi bi-bar-chart"></i> Laporan
    </a>

    <div class="collapse ps-3" id="laporanMenu">
        <a href="/admin/reports/produk">Produk</a>
        <a href="/admin/reports/merchant">Merchant</a>
        <a href="/admin/reports/penjualan">Penjualan</a>
    </div>

    <form action="/logout" method="POST" class="px-3 mt-3">
        @csrf
        <button class="btn btn-danger w-100">
            Logout
        </button>
    </form>

</div>

<!-- CONTENT -->
<div class="content">
    @yield('content')
</div>

<!-- BOOTSTRAP JS (WAJIB) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>