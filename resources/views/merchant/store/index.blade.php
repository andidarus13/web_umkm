@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold">
            <i class="bi bi-shop"></i> Toko Saya
        </h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row">

        <!-- FORM -->
        <div class="col-md-8">
            <div class="card shadow border-0">

                <div class="card-body">

                    <h5 class="mb-4">Informasi Toko</h5>

                    <form method="POST" action="{{ route('store.update') }}" enctype="multipart/form-data">
                    @csrf

                        <!-- LOGO -->
                        <div class="mb-4 text-center">

                            <label class="form-label d-block">Logo Toko</label>

                            <div class="mb-2">
                                <img src="{{ $merchant && $merchant->logo 
                                    ? asset('storage/'.$merchant->logo) 
                                    : 'https://via.placeholder.com/100' }}"
                                     style="height:90px;width:90px;object-fit:cover;border-radius:50%;border:2px solid #eee;">
                            </div>

                            <input type="file" name="logo" class="form-control">
                        </div>

                        <!-- NAMA TOKO -->
                        <div class="mb-3">
                            <label class="form-label">Nama Toko</label>
                            <input 
                                type="text" 
                                name="store_name"
                                value="{{ $merchant->store_name ?? '' }}" 
                                class="form-control"
                                placeholder="Masukkan nama toko">
                        </div>

                        <!-- KOTA -->
                        <div class="mb-3">
                            <label class="form-label">Kota</label>
                            <input 
                                type="text" 
                                name="city"
                                value="{{ $merchant->city ?? '' }}" 
                                class="form-control"
                                placeholder="Contoh: Bandung">
                        </div>

                        <!-- WHATSAPP -->
                        <div class="mb-3">
                            <label class="form-label">Nomor WhatsApp</label>
                            <input 
                                type="text" 
                                name="whatsapp_number"
                                value="{{ $merchant->whatsapp_number ?? '' }}" 
                                class="form-control"
                                placeholder="628xxxxxxxx">
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Toko</label>
                            <textarea 
                                name="description" 
                                class="form-control"
                                rows="4"
                                placeholder="Ceritakan tentang toko kamu">{{ $merchant->description ?? '' }}</textarea>
                        </div>

                        <button class="btn btn-primary w-100">
                            <i class="bi bi-save"></i> Simpan Perubahan
                        </button>

                    </form>

                </div>
            </div>
        </div>

        <!-- SIDEBAR -->
        <div class="col-md-4">

            <!-- TIPS -->
            <div class="card shadow-sm border-0 bg-light mb-3">
                <div class="card-body">

                    <h5 class="mb-3">
                        <i class="bi bi-lightbulb"></i> Tips
                    </h5>

                    <ul class="small mb-0">
                        <li>Gunakan nama toko yang mudah diingat</li>
                        <li>Isi nomor WhatsApp aktif</li>
                        <li>Tambahkan deskripsi menarik</li>
                        <li>Gunakan bahasa yang jelas</li>
                    </ul>

                </div>
            </div>

            <!-- STATUS -->
            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <h6>Status Toko</h6>

                    @if($merchant && ($merchant->is_verified ?? false))
                        <span class="badge bg-success">Terverifikasi</span>
                    @else
                        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                    @endif

                </div>
            </div>

        </div>

    </div>

</div>

@endsection