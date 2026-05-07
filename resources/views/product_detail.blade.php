<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ICON -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --primary: #e11d48;
            --secondary: #16a34a;
        }

        html, body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background: #f9fafb;
        }

        .content {
            flex: 1;
        }

        /* NAVBAR */
        .navbar-custom {
            background: white;
            padding: 15px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* IMAGE */
        .product-img {
            border-radius: 12px;
            transition: 0.3s;
        }

        .product-img:hover {
            transform: scale(1.02);
        }

        /* BUTTON WA */
        .btn-wa {
            background: var(--secondary);
            color: white;
            font-weight: 500;
        }

        .btn-wa:hover {
            background: #15803d;
        }

        /* FOOTER */
        footer {
            background: #111827;
            color: white;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<div class="navbar-custom">
    <div class="container d-flex justify-content-between align-items-center">

        <a href="/" class="d-flex align-items-center gap-2 text-decoration-none">
            <img src="{{ asset('karyalokal.png') }}" style="height:80px;">
            <span class="fw-bold fs-5" style="color:var(--primary)"></span>
        </a>

        <a href="/login" class="btn btn-outline-dark btn-sm">
            
        </a>

    </div>
</div>

<!-- CONTENT -->
<div class="content">
<div class="container mt-5">

    <div class="row align-items-center">

        <!-- IMAGE -->
        <div class="col-md-6 mb-4">
            <img src="{{ asset('storage/'.$product->image) }}" 
                 class="w-100 shadow product-img">
        </div>

        <!-- DETAIL -->
        <div class="col-md-6">

            <h2 class="fw-bold">{{ $product->name }}</h2>

            <p class="text-muted mb-1">
                {{ $product->merchant->store_name ?? '-' }}
            </p>

            <h3 class="fw-bold text-primary mb-3">
                Rp {{ number_format($product->price) }}
            </h3>

            <p>
                {{ $product->description }}
            </p>

            <!-- BUTTON WA -->
            @php
$pesan = urlencode(
    "Halo, saya tertarik dengan produk:\n".
    "🛍️ ".$product->name."\n".
    "💰 Rp ".number_format($product->price)."\n\n".
    "Apakah masih tersedia?"
);
@endphp

<a href="https://wa.me/{{ $product->merchant->whatsapp_number ?? '628000000000' }}?text={{ $pesan }}"
   target="_blank"
   class="btn btn-wa w-100 mt-3 d-flex align-items-center justify-content-center gap-2">

    <i class="bi bi-whatsapp"></i> 
    Chat WhatsApp

</a>

        </div>

    </div>

</div>
</div>

<!-- FOOTER -->
<footer class="text-center p-3 mt-5">
    © 2026 KaryaLokal Marketplace 🚀
</footer>

</body>
</html>