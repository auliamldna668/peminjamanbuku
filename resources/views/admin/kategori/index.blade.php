@extends('layouts.app')

@section('content')
<div class="page-wrapper">

    <div class="page-header">
        <div>
            <h1 class="page-title">Kategori Buku</h1>
            <p class="page-subtitle">Kelola data kategori buku</p>
        </div>

        <a href="{{ url('/admin/kategori/create') }}" class="btn-gold">
            + Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width:80px;">No</th>
                    <th>Nama Kategori</th>
                </tr>
            </thead>

            <tbody>
                @forelse($kategoris as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td class="book-title-cell">{{ $k->nama_kategori }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="text-align:center; padding:20px; color:#9ca3af;">
                            Belum ada data kategori
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection