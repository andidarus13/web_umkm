@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <!-- GREETING -->
    <div class="mb-4">
        <h3 class="fw-bold">👋 Halo, {{ auth()->user()->name }}</h3>
        <p class="text-muted">Selamat datang di dashboard admin UMKM</p>
    </div>

    <!-- STATS -->
    <div class="row g-4">

        <div class="col-md-4">
            <div class="card text-white shadow border-0" style="background: linear-gradient(45deg,#4e73df,#224abe)">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total User</h6>
                        <h2>{{ $users }}</h2>
                    </div>
                    <i class="bi bi-people fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white shadow border-0" style="background: linear-gradient(45deg,#1cc88a,#13855c)">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Merchant</h6>
                        <h2>{{ $merchants }}</h2>
                    </div>
                    <i class="bi bi-shop fs-1"></i>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white shadow border-0" style="background: linear-gradient(45deg,#36b9cc,#258391)">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h6>Total Produk</h6>
                        <h2>{{ $products }}</h2>
                    </div>
                    <i class="bi bi-box-seam fs-1"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- CHART + TABLE -->
    <div class="row mt-4">

        <!-- CHART -->
        <div class="col-md-7">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5>📊 Statistik Sistem</h5>
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>

        <!-- RECENT MERCHANT -->
        <div class="col-md-5">
            <div class="card shadow border-0">
                <div class="card-body">
                    <h5>🆕 Merchant Terbaru</h5>

                    <table class="table mt-3">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach(\App\Models\Merchant::latest()->take(5)->get() as $m)
                            <tr>
                                <td>{{ $m->store_name }}</td>
                                <td>
                                    @if($m->is_verified)
                                        <span class="badge bg-success">Verified</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

    </div>

</div>

<!-- CHART -->
<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Users', 'Merchant', 'Produk'],
        datasets: [{
            label: 'Total',
            data: [{{ $users }}, {{ $merchants }}, {{ $products }}],
            tension: 0.4
        }]
    },
    options: {
        plugins: {
            legend: { display: false }
        }
    }
});
</script>

@endsection