@extends('layouts.app')

@section('content')

<h3>Edit Produk</h3>

<form method="POST" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data">
@csrf @method('PUT')

<div class="mb-3">
    <label>Nama Produk</label>
    <input type="text" name="name" value="{{ $product->name }}" class="form-control">
</div>

<div class="mb-3">
    <label>Kategori</label>
    <select name="category_id" class="form-control">
        @foreach($categories as $c)
            <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
                {{ $c->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Harga</label>
    <input type="number" name="price" value="{{ $product->price }}" class="form-control">
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
</div>

<div class="mb-3">
    <label>Gambar</label>
    <input type="file" name="image" class="form-control">
</div>

<button class="btn btn-primary">Update</button>

</form>

@endsection