@extends('layouts.app')

@section('content')

<h3>Tambah Produk</h3>

<form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
@csrf

<div class="mb-3">
    <label>Nama Produk</label>
    <input type="text" name="name" class="form-control">
</div>

<div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" class="form-control">
        @foreach($categories as $c)
            <option value="{{ $c->id }}">{{ $c->name }}</option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Harga</label>
    <input type="number" name="price" class="form-control">
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label>Gambar</label>
    <input type="file" name="image" class="form-control">
</div>

<button class="btn btn-success">Simpan</button>

</form>

@endsection