@extends('layouts.app')

@section('content')

<div class="container mt-4">

<h4>Semua Produk</h4>

<div class="row">
@foreach($products as $p)
<div class="col-md-3 mb-4">
    <div class="card shadow-sm">

        <img src="{{ asset('storage/'.$p->image) }}" style="height:180px">

        <div class="card-body">
            <h6>{{ $p->name }}</h6>
            <p>Rp {{ number_format($p->price) }}</p>

            <a href="/product/{{ $p->slug }}" class="btn btn-dark w-100">
                Detail
            </a>
        </div>

    </div>
</div>
@endforeach
</div>

{{ $products->links() }}

</div>

@endsection