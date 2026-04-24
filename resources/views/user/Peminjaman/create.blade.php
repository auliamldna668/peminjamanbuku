@extends('layouts.plain')

@section('content')

<div class="page-wrapper">

    <div class="page-header">
        <h1 class="page-title">📖 Pinjam Buku</h1>
    </div>

    <div class="form-wrapper" style="max-width:500px;">

        <form action="{{ route('user.peminjaman.store') }}" method="POST">

            @csrf

            <!-- ID Buku -->
            <input type="hidden" name="buku_id" value="{{ $buku->id ?? '' }}">

            <!-- Nama Anggota -->
            <div style="margin-bottom:10px;">
                <label>Nama Anggota</label>
                <input type="text"
                       value="{{ auth()->user()->name }}"
                       readonly
                       style="width:100%;">
            </div>

            <!-- Judul Buku -->
            <div style="margin-bottom:10px;">
                <label>Judul Buku</label>
                <input type="text"
                       value="{{ $buku->judul ?? '-' }}"
                       readonly
                       style="width:100%;">
                <input type="hidden" name="judul" value="{{ $buku->judul ?? '' }}">
            </div>

            <!-- Pengarang -->
            <div style="margin-bottom:10px;">
                <label>Pengarang</label>
                <input type="text"
                       value="{{ $buku->penulis ?? '-' }}" {{-- ✅ fix --}}
                       readonly
                       style="width:100%;">
            </div>

            <!-- Kategori -->
            <div style="margin-bottom:10px;">
                <label>Kategori</label>
                <input type="text"
                       value="{{ $buku->kategori->nama_kategori ?? '-' }}"
                       readonly
                       style="width:100%;">
            </div>

            <!-- Tanggal Pinjam -->
            <div style="margin-bottom:10px;">
                <label>Tanggal Pinjam</label>
                <input type="date"
                       name="tanggal_pinjam"
                       value="{{ date('Y-m-d') }}"
                       required
                       style="width:100%;">
            </div>

            <!-- Jumlah -->
            <div style="margin-bottom:10px;">
                <label>Jumlah</label>
                <input type="number"
                       name="jumlah"
                       min="1"
                       value="1"
                       required
                       style="width:100%;">
            </div>

            <button type="submit" class="btn-edit" style="width:100%;">
                📖 Konfirmasi Pinjam
            </button>

        </form>

    </div>

</div>

@endsection