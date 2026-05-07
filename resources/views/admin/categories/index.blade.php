@extends('layouts.admin')

@section('content')

<h3 class="mb-4 fw-bold">🏷️ Manajemen Kategori</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- FORM TAMBAH -->
<form method="POST" action="/admin/categories" class="row g-2 mb-3">
    @csrf

    <div class="col-md-10">
        <input type="text" name="name" class="form-control" placeholder="Nama kategori" required>
    </div>

    <div class="col-md-2">
        <button class="btn btn-primary w-100">Tambah</button>
    </div>

</form>

<!-- TABLE -->
<div class="card shadow-sm p-3">

<table class="table table-striped align-middle">

<thead class="table-light">
<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Slug</th>
    <th>Aksi</th>
</tr>
</thead>

<tbody>
@foreach($categories as $i => $c)
<tr>

    <td>{{ $i+1 }}</td>

    <td>
        <form method="POST" action="/admin/categories/{{ $c->id }}">
            @csrf
            @method('PUT')

            <input type="text" name="name" value="{{ $c->name }}" class="form-control form-control-sm">
    </td>

    <td>{{ $c->slug }}</td>

    <td class="d-flex gap-2">

            <button class="btn btn-warning btn-sm">Update</button>
        </form>

        <form method="POST" action="/admin/categories/{{ $c->id }}"
              onsubmit="return confirm('Hapus kategori?')">
            @csrf
            @method('DELETE')

            <button class="btn btn-danger btn-sm">
                <i class="bi bi-trash"></i>
            </button>
        </form>

    </td>

</tr>
@endforeach

</tbody>

</table>

</div>

@endsection