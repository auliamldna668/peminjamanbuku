@extends('layouts.plain')

@section('content')

<div class="page-wrapper">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">📖 Tambah Buku</h1>
            <p class="page-subtitle">Tambah koleksi perpustakaan baru</p>
        </div>
        <a href="{{ url('/admin/buku') }}" class="btn-gold">← Kembali</a>
    </div>

    {{-- FORM CARD --}}
    <div class="form-card">
        <form action="/admin/buku/store" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Judul</label>
                <input type="text" name="judul" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Penulis</label>
                <input type="text" name="penulis" class="form-input" required>
            </div>

            <!-- <div class="form-group">
                <label class="form-label">Penerbit</label>
                <input type="text" name="penerbit" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-input">
            </div> -->

            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="kategori_id" class="form-input" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-input">
            </div>

            <div class="form-group">
                <label class="form-label">Foto Cover</label>
                <input type="file" name="foto" class="form-input-file">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-gold">💾 Simpan</button>
            </div>

        </form>
    </div>

</div>

@endsection