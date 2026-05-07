<!DOCTYPE html>
<html>
<head>
    <title>KaryaLokal - Marketplace UMKM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #e11d48;
            --secondary: #16a34a;
            --dark: #111827;
        }

        body {
            background: #f8fafc;
            font-family: 'Segoe UI', sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background: white;
            transition: 0.3s;
        }

        .navbar img {
            transition: 0.3s;
        }

        .navbar img:hover {
            transform: scale(1.1);
        }

        /* HERO */
        .hero {
            background: linear-gradient(120deg, var(--primary), var(--secondary));
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .search-box {
            background: white;
            border-radius: 12px;
            padding: 10px;
            margin-top: 20px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        /* CATEGORY */
        .category-scroll {
            overflow-x: auto;
            white-space: nowrap;
            padding-bottom: 10px;
        }

        .category-item {
            display: inline-block;
            background: white;
            padding: 10px 20px;
            border-radius: 20px;
            margin-right: 10px;
            border: 1px solid #ddd;
            cursor: pointer;
            transition: 0.3s;
        }

        .category-item:hover {
            background: var(--primary);
            color: white;
        }

        /* PRODUCT */
        .product-card {
            border-radius: 12px;
            transition: 0.3s;
            overflow: hidden;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .product-img {
            height: 180px;
            object-fit: cover;
        }

        .price {
            color: var(--primary);
            font-weight: bold;
        }

        /* BUTTON */
        .btn-primary {
            background: var(--primary);
            border: none;
        }

        .btn-primary:hover {
            background: #be123c;
        }

        .btn-success {
            background: var(--secondary);
            border: none;
        }

        /* ANIMATION */
        .fade-up {
            animation: fadeUp 0.6s ease;
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

        footer {
            background: var(--dark);
            color: white;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar shadow-sm sticky-top py-2">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- LOGO -->
        <a href="/" class="d-flex align-items-center gap-2 text-decoration-none">

            <img src="{{ asset('karyalokal.png') }}"
                 style="height:80px; width:auto; display:block;">

            <span class="fw-bold fs-5 mb-0" style="color:var(--primary)">
            
            </span>

        </a>

        <div>
            <a href="/login" class="btn btn-outline-dark btn-sm">Login</a>
            <a href="/register" class="btn btn-primary btn-sm">Daftar</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<div class="hero fade-up">
    <div class="container">

        <h2 class="fw-bold">Belanja Produk Lokal 🇮🇩</h2>
        <p>Dukung UMKM Indonesia dengan mudah</p>

        <form class="search-box row g-2 justify-content-center">

            <div class="col-md-5">
                <input type="text" name="search"
                       class="form-control"
                       placeholder="Cari produk..."
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <button class="btn btn-dark w-100">Cari</button>
            </div>

        </form>

    </div>
</div>

<!-- CATEGORY -->
<div class="container mt-4 fade-up">

    <div class="category-scroll">

        @foreach($categories as $c)
            <a href="?category={{ $c->id }}"
               class="category-item text-decoration-none text-dark">
                {{ $c->name }}
            </a>
        @endforeach

    </div>

</div>

<!-- PRODUK -->
<div class="container mt-4 fade-up">

    <div class="row">

        @foreach($products as $p)
        <div class="col-md-3 mb-4">

            <div class="card product-card shadow-sm border-0">

                <img src="{{ asset('storage/'.$p->image) }}"
                     class="product-img w-100">

                <div class="p-3">

                    <h6>{{ $p->name }}</h6>

                    <small class="text-muted">
                        {{ $p->merchant->store_name ?? '-' }}
                    </small>

                    <div class="price mt-2">
                        Rp {{ number_format($p->price) }}
                    </div>

                    <div class="d-flex gap-2 mt-3">

                        <a href="/product/{{ $p->slug }}"
                           class="btn btn-outline-dark btn-sm w-50">
                            Detail
                        </a>

                        @php
$pesan = urlencode(
    "Halo, saya tertarik dengan produk:\n".
    "🛍️ ".$p->name."\n".
    "💰 Rp ".number_format($p->price)."\n\n".
    "Apakah masih tersedia?"
);
@endphp

<a href="https://wa.me/{{ $p->merchant->whatsapp_number ?? '628000000000' }}?text={{ $pesan }}"
   target="_blank"
   class="btn btn-success btn-sm w-50 d-flex align-items-center justify-content-center gap-1">

    <i class="bi bi-whatsapp"></i>
    Chat

</a>

                    </div>

                </div>

            </div>

        </div>
        @endforeach

    </div>

</div>

<!-- FOOTER -->
<footer class="mt-5 pt-5 pb-3">

    <div class="container">

        <div class="row">

            <!-- ABOUT -->
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold">KaryaLokal</h5>
                <p class="small">
                    KaryaLokal adalah platform marketplace yang membantu UMKM Indonesia 
                    menjangkau lebih banyak pelanggan secara digital.
                </p>
            </div>

            <!-- MENU -->
            <div class="col-md-3 mb-4">
                <h6 class="fw-semibold">Menu</h6>
                <ul class="list-unstyled small">
                    <li><a href="/" class="text-white text-decoration-none">Home</a></li>
                    <li><a href="{ route('produk') }}" class="text-white text-decoration-none">Produk</a></li>
                    <li><a href="/login" class="text-white text-decoration-none">Login</a></li>
                </ul>
            </div>

            <!-- SUPPORT -->
            <div class="col-md-2 mb-4">
                <h6 class="fw-semibold">Support</h6>
                <ul class="list-unstyled small">
                    <li><a href="#" class="text-white text-decoration-none">FAQ</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Privacy</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Terms</a></li>
                </ul>
            </div>

            <!-- CONTACT -->
            <div class="col-md-3 mb-4">
                <h6 class="fw-semibold">Kontak</h6>
                <p class="small mb-1">📧 support@karyalokal.com</p>
                <p class="small mb-1">📱 0812-xxxx-xxxx</p>
                <p class="small">📍 Indonesia</p>
            </div>

        </div>

        <hr style="border-color:rgba(255,255,255,0.2)">

        <div class="text-center small">
            © 2026 KaryaLokal — Dukung UMKM Indonesia 🇮🇩
        </div>

    </div>

</footer>

</body>
</html>