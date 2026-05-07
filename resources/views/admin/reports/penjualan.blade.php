@extends('layouts.admin')

@section('content')

<h3 class="mb-4 fw-bold">📈 Laporan Produk</h3>

<!-- BUTTON EXPORT -->
<div class="mb-3 d-flex justify-content-end gap-2">

    <a href="/admin/reports/penjualan/csv" class="btn btn-success">
        <i class="bi bi-file-earmark-excel"></i> Export Excel
    </a>

    <a href="/admin/reports/penjualan/pdf" class="btn btn-danger">
        <i class="bi bi-file-earmark-pdf"></i> Export PDF
    </a>

</div>

<!-- TABLE -->
<div class="card p-3 shadow-sm">

<table class="table table-striped align-middle">

<thead class="table-light">
<tr>
    <th>Produk</th>
    <th>Merchant</th>
    <th>Kategori</th>
    <th>Harga</th>
</tr>
</thead>

<tbody>
@foreach($products as $p)
<tr>
    <td class="fw-semibold">{{ $p->name }}</td>
    <td>{{ $p->merchant->store_name ?? '-' }}</td>
    <td>{{ $p->category->name ?? '-' }}</td>
    <td>Rp {{ number_format($p->price) }}</td>
</tr>
@endforeach
</tbody>

</table>

</div>

@endsection