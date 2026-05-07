@extends('layouts.admin')

@section('content')

<h3 class="mb-4">📦 Laporan Produk</h3>

<div class="row mb-3">
    <div class="col-md-4">
        <div class="card p-3 shadow">
            <h6>Total Produk</h6>
            <h2>{{ $totalProduk }}</h2>
        </div>
    </div>
</div>

<div class="card p-3 shadow">
    <table class="table">
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Jumlah Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $c)
            <tr>
                <td>{{ $c->name }}</td>
                <td>{{ $c->products_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection