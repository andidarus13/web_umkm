@extends('layouts.admin')

@section('content')

<h3 class="mb-4 fw-bold">🏪 Verifikasi Merchant</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- FILTER -->
<div class="card p-3 mb-3 shadow-sm">
    <form class="row g-2">

        <div class="col-md-4">
            <input type="text" name="search" class="form-control"
                   placeholder="Cari nama toko..."
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="0" {{ request('status')==='0'?'selected':'' }}>Pending</option>
                <option value="1" {{ request('status')==='1'?'selected':'' }}>Verified</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark w-100">Filter</button>
        </div>

    </form>
</div>

<!-- TABLE -->
<div class="card shadow-sm border-0">
<div class="table-responsive">

<table class="table align-middle mb-0">

<thead class="table-light">
<tr>
    <th>User</th>
    <th>Toko</th>
    <th>Kota</th>
    <th>Status</th>
    <th class="text-center" style="width: 180px;">Aksi</th>
</tr>
</thead>

<tbody>

@forelse($merchants as $m)
<tr>

    <td>{{ $m->user->name ?? '-' }}</td>

    <td class="fw-semibold">{{ $m->store_name }}</td>

    <td>{{ $m->city }}</td>

    <td>
        @if($m->is_verified)
            <span class="badge bg-success">✔ Verified</span>
        @else
            <span class="badge bg-warning text-dark">⏳ Pending</span>
        @endif
    </td>

    <td class="text-center">

        <div class="d-flex justify-content-center gap-2 flex-wrap">

            <!-- DETAIL -->
            <button class="btn btn-sm btn-outline-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#detail{{ $m->id }}">
                <i class="bi bi-eye"></i>
            </button>

            <!-- VERIFY -->
            @if(!$m->is_verified)
            <form method="POST" action="/admin/merchants/{{ $m->id }}/verify" class="m-0">
                @csrf
                <button class="btn btn-sm btn-success">
                    <i class="bi bi-check-lg"></i>
                </button>
            </form>
            @endif

            <!-- DELETE -->
            <form method="POST" action="/admin/merchants/{{ $m->id }}"
                  onsubmit="return confirm('Yakin hapus merchant ini?')"
                  class="m-0">
                @csrf
                @method('DELETE')

                <button class="btn btn-sm btn-danger">
                    <i class="bi bi-trash"></i>
                </button>
            </form>

        </div>

    </td>

</tr>

<!-- MODAL DETAIL -->
<div class="modal fade" id="detail{{ $m->id }}">
    <div class="modal-dialog">
        <div class="modal-content p-4">

            <h5 class="mb-3">{{ $m->store_name }}</h5>

            <p><b>User:</b> {{ $m->user->name }}</p>
            <p><b>Kota:</b> {{ $m->city }}</p>
            <p><b>WA:</b> {{ $m->whatsapp_number }}</p>

            <p>
                <b>Status:</b>
                @if($m->is_verified)
                    <span class="badge bg-success">Verified</span>
                @else
                    <span class="badge bg-warning">Pending</span>
                @endif
            </p>

        </div>
    </div>
</div>

@empty
<tr>
    <td colspan="5" class="text-center text-muted">
        Tidak ada data merchant
    </td>
</tr>
@endforelse

</tbody>

</table>

</div>
</div>

<!-- PAGINATION -->
<div class="mt-3">
    {{ $merchants->withQueryString()->links() }}
</div>

@endsection