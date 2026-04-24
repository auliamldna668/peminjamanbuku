@extends('layouts.plain')

@section('content')
<div class="page-wrapper">

    <h1 class="page-title">Tambah Kategori</h1>
    <p class="page-subtitle">Tambahkan kategori baru ke sistem</p>

    <div class="form-card" style="margin-top:20px;">

        <form action="/admin/kategori/store" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Nama Kategori</label>
                <input 
                    type="text" 
                    name="nama_kategori"
                    class="form-input"
                    placeholder="Masukkan nama kategori"
                    required
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-gold">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>
@endsection