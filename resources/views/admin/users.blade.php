@extends('layouts.admin')

@section('content')

<h3 class="mb-4 fw-bold">👤 Manajemen User</h3>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!-- ================= TOP BAR ================= -->
<div class="card shadow-sm p-3 mb-3">
    <form method="GET">
        <div class="row g-2 align-items-end">

            <!-- SEARCH -->
            <div class="col-md-4">
                <label class="form-label small">Search</label>
                <input type="text" name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Cari nama atau email...">
            </div>

            <!-- ROLE -->
            <div class="col-md-3">
                <label class="form-label small">Role</label>
                <select name="role" class="form-select">
                    <option value="">Semua</option>
                    <option value="admin" {{ request('role')=='admin'?'selected':'' }}>Admin</option>
                    <option value="merchant" {{ request('role')=='merchant'?'selected':'' }}>Merchant</option>
                    <option value="visitor" {{ request('role')=='visitor'?'selected':'' }}>Visitor</option>
                </select>
            </div>

            <!-- BUTTON -->
            <div class="col-md-5 d-flex gap-2">
                <button class="btn btn-dark w-50">Filter</button>

                <button type="button" class="btn btn-primary w-50"
                        data-bs-toggle="modal" data-bs-target="#addUser">
                    + User
                </button>
            </div>

        </div>
    </form>
</div>

<!-- ================= TABLE ================= -->
<div class="card shadow-sm border-0 p-3">

<table class="table table-striped align-middle">

<thead class="table-light">
<tr>
    <th>Nama</th>
    <th>Email</th>
    <th>Role</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
@forelse($users as $u)
<tr>

    <td class="fw-semibold">{{ $u->name }}</td>
    <td>{{ $u->email }}</td>

    <td>
        <span class="badge bg-info text-dark">
            {{ ucfirst($u->role) }}
        </span>
    </td>

    <td>
        <div class="d-flex justify-content-center gap-2 flex-wrap">

            <!-- UPDATE ROLE -->
            <form method="POST" action="/admin/users/{{ $u->id }}/role">
                @csrf
                <div class="d-flex gap-1">
                    <select name="role" class="form-select form-select-sm">
                        <option value="admin" {{ $u->role=='admin'?'selected':'' }}>Admin</option>
                        <option value="merchant" {{ $u->role=='merchant'?'selected':'' }}>Merchant</option>
                        <option value="visitor" {{ $u->role=='visitor'?'selected':'' }}>Visitor</option>
                    </select>
                    <button class="btn btn-success btn-sm">✔</button>
                </div>
            </form>

            <!-- DELETE -->
            <form method="POST" action="/admin/users/{{ $u->id }}"
                  onsubmit="return confirm('Hapus user ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
            </form>

        </div>
    </td>

</tr>
@empty
<tr>
    <td colspan="4" class="text-center text-muted">
        Data tidak ditemukan
    </td>
</tr>
@endforelse
</tbody>

</table>

</div>

<!-- ================= BOTTOM BAR FIX ================= -->
<div class="mt-3">

    <!-- ROW 1 -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

        <!-- INFO -->
        <div class="text-muted small">
            Showing {{ $users->firstItem() ?? 0 }} 
            to {{ $users->lastItem() ?? 0 }} 
            of {{ $users->total() }} results
        </div>

        <!-- SHOW -->
        <form method="GET" class="d-flex align-items-center gap-2">
            <span class="small text-muted">Show</span>

            <input type="hidden" name="search" value="{{ request('search') }}">
            <input type="hidden" name="role" value="{{ request('role') }}">

            <select name="limit" class="form-select form-select-sm"
                    style="width:80px"
                    onchange="this.form.submit()">
                <option value="5">5</option>
                <option value="10" {{ request('limit')==10?'selected':'' }}>10</option>
                <option value="25" {{ request('limit')==25?'selected':'' }}>25</option>
                <option value="50" {{ request('limit')==50?'selected':'' }}>50</option>
            </select>
        </form>

    </div>

    <!-- ROW 2 (PAGINATION SENDIRIAN) -->
    <div class="d-flex justify-content-end mt-2">
        {{ $users->appends(request()->all())->links() }}
    </div>

</div>

    </div>

</div>

<!-- ================= MODAL ================= -->
<div class="modal fade" id="addUser">
    <div class="modal-dialog">
        <form method="POST" action="/admin/users">
            @csrf

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Tambah User</h5>
                </div>

                <div class="modal-body">
                    <input type="text" name="name" class="form-control mb-2" placeholder="Nama" required>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                    <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>

                    <select name="role" class="form-select">
                        <option value="admin">Admin</option>
                        <option value="merchant">Merchant</option>
                        <option value="visitor">Visitor</option>
                    </select>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection