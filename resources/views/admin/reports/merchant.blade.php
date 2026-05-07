@extends('layouts.admin')

@section('content')

<h3 class="mb-4 fw-bold">🏪 Laporan Merchant</h3>

<!-- ================= FILTER & SEARCH ================= -->
<form method="GET" action="/admin/reports/merchant" class="row g-2 mb-3">

    <!-- SEARCH -->
    <div class="col-md-3">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control" placeholder="Cari nama toko...">
    </div>

    <!-- FILTER MERCHANT -->
    <div class="col-md-3">
        <select name="merchant_id" class="form-control">
            <option value="">Semua Merchant</option>
            @foreach($allMerchants as $m)
                <option value="{{ $m->id }}"
                    {{ request('merchant_id') == $m->id ? 'selected' : '' }}>
                    {{ $m->store_name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- TANGGAL -->
    <div class="col-md-2">
        <input type="date" name="from" value="{{ request('from') }}" class="form-control">
    </div>

    <div class="col-md-2">
        <input type="date" name="to" value="{{ request('to') }}" class="form-control">
    </div>

    <div class="col-md-2 d-flex gap-2">
        <button class="btn btn-primary w-100">Filter</button>
        <a href="/admin/reports/merchant" class="btn btn-secondary w-100">Reset</a>
    </div>

</form>

<!-- ================= EXPORT ================= -->
<div class="mb-3 d-flex justify-content-between align-items-center">

    <h5 class="mb-0">Export Data</h5>

    <div class="d-flex gap-2">
        <a href="/admin/reports/merchant/csv?{{ http_build_query(request()->all()) }}"
           class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Excel
        </a>

        <a href="/admin/reports/merchant/pdf?{{ http_build_query(request()->all()) }}"
           class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> PDF
        </a>
    </div>

</div>

<!-- ================= STATS ================= -->
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Total Merchant</h6>
            <h2>{{ $totalMerchant }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Aktif</h6>
            <h2>{{ $merchants->where('products_count','>',0)->count() }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Verified</h6>
            <h2>{{ $merchants->where('is_verified',1)->count() }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow-sm">
            <h6>Tidak Aktif</h6>
            <h2>{{ $merchants->where('products_count',0)->count() }}</h2>
        </div>
    </div>

</div>

<!-- ================= CHART ================= -->
<div class="card p-3 shadow-sm mb-4">
    <h5>📊 Top Merchant</h5>
    <canvas id="merchantChart"></canvas>
</div>

<!-- ================= TABLE ================= -->
<div class="card shadow-sm">

<div class="table-responsive">
<table class="table align-middle">

<thead class="table-light">
<tr>
    <th>No</th>
    <th>Nama Toko</th>
    <th>Status</th>
    <th>Total Produk</th>
</tr>
</thead>

<tbody>
@forelse($merchants as $i => $m)
<tr>
    <td>{{ $loop->iteration }}</td>

    <td class="fw-semibold">{{ $m->store_name }}</td>

    <td>
        @if($m->is_verified)
            <span class="badge bg-success">Verified</span>
        @else
            <span class="badge bg-warning text-dark">Pending</span>
        @endif
    </td>

    <td>
        <span class="badge bg-primary">
            {{ $m->products_count }}
        </span>
    </td>
</tr>
@empty
<tr>
    <td colspan="4" class="text-center">Data tidak ditemukan</td>
</tr>
@endforelse
</tbody>

</table>
</div>

<!-- PAGINATION -->
<div class="p-3">
    {{ $merchants->links() }}
</div>

</div>

<!-- ================= CHART SCRIPT ================= -->
<script>
new Chart(document.getElementById('merchantChart'), {
    type: 'bar',
    data: {
        labels: @json($topMerchants->pluck('store_name')),
        datasets: [{
            label: 'Jumlah Produk',
            data: @json($topMerchants->pluck('products_count'))
        }]
    }
});
</script>

@endsection