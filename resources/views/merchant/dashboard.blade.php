@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <h3 class="mb-4 fw-bold">
        <i class="bi bi-speedometer2"></i> Dashboard Merchant
    </h3>

    <div class="row g-4">

        {{-- TOTAL PRODUK --}}
        <div class="col-md-3">
            <div class="card bg-primary text-white shadow-sm border-0 p-3">
                <h6>Total Produk</h6>
                <h2>
                    {{ auth()->user()->merchant ? auth()->user()->merchant->products->count() : 0 }}
                </h2>
            </div>
        </div>

        {{-- TOTAL KATEGORI --}}
        <div class="col-md-3">
            <div class="card bg-success text-white shadow-sm border-0 p-3">
                <h6>Kategori</h6>
                <h2>{{ \App\Models\Category::count() }}</h2>
            </div>
        </div>

        {{-- STATUS --}}
        <div class="col-md-3">
            <div class="card bg-dark text-white shadow-sm border-0 p-3">
                <h6>Status</h6>

                @if(auth()->user()->merchant && auth()->user()->merchant->is_verified ?? false)
                    <h5 class="mt-2 badge bg-success">Verified</h5>
                @else
                    <h5 class="mt-2 badge bg-warning text-dark">Pending</h5>
                @endif
            </div>
        </div>

        {{-- QUICK ACTION --}}
        <div class="col-md-3">
            <div class="card bg-warning shadow-sm border-0 p-3">
                <h6>Quick Action</h6>
                <a href="/merchant/products/create" class="btn btn-dark btn-sm mt-2">
                    + Tambah Produk
                </a>
            </div>
        </div>

    </div>

    {{-- CHART --}}
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-3">
                <h5>Statistik Produk</h5>
                <canvas id="productChart"></canvas>
            </div>
        </div>

        {{-- INFO --}}
        <div class="col-md-4">
            <div class="card shadow-sm border-0 p-3">
                <h5>Tips</h5>
                <ul>
                    <li>Upload gambar berkualitas</li>
                    <li>Isi deskripsi jelas</li>
                    <li>Gunakan kategori yang tepat</li>
                </ul>
            </div>
        </div>
    </div>

    {{-- PRODUK TERBARU --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 p-3">
                <h5>Produk Terbaru</h5>

                <table class="table">
                    <tr>
                        <th>Nama</th>
                        <th>Harga</th>
                    </tr>

                    @if(auth()->user()->merchant)
                        @foreach(auth()->user()->merchant->products->take(5) as $p)
                        <tr>
                            <td>{{ $p->name }}</td>
                            <td>Rp {{ number_format($p->price) }}</td>
                        </tr>
                        @endforeach
                    @endif

                </table>

            </div>
        </div>
    </div>

</div>

{{-- SCRIPT CHART --}}
<script>
    const ctx = document.getElementById('productChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],
            datasets: [{
                label: 'Jumlah Produk',
                data: [3, 5, 2, 8, 6, 4],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
</script>

@endsection