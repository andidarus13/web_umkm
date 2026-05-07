@extends('layouts.app')

@section('content')

<h3 class="mb-4 fw-bold">📦 Produk Saya</h3>

<!-- ACTION BAR -->
<div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">

    <!-- LEFT -->
    <a href="{{ route('products.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Produk
    </a>

    <!-- RIGHT -->
    <div class="d-flex gap-2">
        <a href="/merchant/products/export/csv" class="btn btn-success">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>

        <a href="/merchant/products/export/pdf" class="btn btn-danger">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>

</div>

<!-- ALERT -->
@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- PRODUCT GRID -->
<div class="row">

@forelse($products as $p)

<div class="col-md-4 mb-4">
    <div class="card shadow-sm border-0 h-100">

        <!-- IMAGE -->
        @if($p->image)
            <img src="{{ asset('storage/'.$p->image) }}"
                 class="card-img-top"
                 style="height:200px;object-fit:cover;">
        @else
            <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px;">
                <span class="text-muted">No Image</span>
            </div>
        @endif

        <!-- BODY -->
        <div class="card-body d-flex flex-column">

            <h5 class="fw-semibold">{{ $p->name }}</h5>

            <small class="text-muted">
                {{ $p->category->name ?? '-' }}
            </small>

            <h6 class="mt-2 text-primary">
                Rp {{ number_format($p->price) }}
            </h6>

            <!-- BUTTON -->
            <div class="mt-auto">

                <div class="d-flex justify-content-between gap-2">

                    <!-- EDIT -->
                    <a href="{{ route('products.edit',$p->id) }}"
                       class="btn btn-warning btn-sm w-100">
                        <i class="bi bi-pencil"></i>
                    </a>

                    <!-- DELETE -->
                    <form action="{{ route('products.destroy',$p->id) }}"
                          method="POST"
                          class="w-100"
                          onsubmit="return confirm('Hapus produk ini?')">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-danger btn-sm w-100">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>

                </div>

                <!-- WHATSAPP -->
                <a href="https://wa.me/{{ auth()->user()->merchant->whatsapp_number }}?text=Halo saya tertarik dengan produk {{ $p->name }}"
                   target="_blank"
                   class="btn btn-success btn-sm mt-2 w-100">
                    <i class="bi bi-whatsapp"></i> Chat WhatsApp
                </a>

            </div>

        </div>
    </div>
</div>

@empty

<div class="col-12">
    <div class="alert alert-secondary text-center">
        Belum ada produk
    </div>
</div>

@endforelse

</div>

@endsection