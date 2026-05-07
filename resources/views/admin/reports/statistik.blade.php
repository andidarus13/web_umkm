@extends('layouts.admin')

@section('content')

<h3 class="mb-4">📊 Statistik Sistem</h3>

<div class="row">

    <div class="col-md-4">
        <div class="card p-3 shadow text-center">
            <h6>Produk</h6>
            <h2>{{ $totalProduk }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow text-center">
            <h6>Kategori</h6>
            <h2>{{ $totalKategori }}</h2>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card p-3 shadow text-center">
            <h6>Merchant</h6>
            <h2>{{ $totalMerchant }}</h2>
        </div>
    </div>

</div>

@endsection