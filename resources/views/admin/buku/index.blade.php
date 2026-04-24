@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">📚 Data Buku</h1>
            <p class="page-subtitle">Kelola koleksi perpustakaan</p>
        </div>

        <form method="GET" action="{{ route('admin.buku.index') }}" class="search-form">
            <input type="text" name="keyword" placeholder="Cari buku..." value="{{ request('keyword') }}">
            <button type="submit">Search</button>
        </form>

        <a href="{{ url('/admin/buku/create') }}" class="btn-gold">
            + Tambah Buku
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Foto</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($buku as $item)
                    <tr>

                        {{-- NO --}}
                        <td>{{ $loop->iteration }}</td>

                        {{-- JUDUL --}}
                        <td>
                            <div class="book-title-cell">
                                {{ $item->judul }}
                            </div>
                        </td>

                        {{-- PENGARANG --}}
                        <td>{{ $item->pengarang ?? $item->penulis ?? '-' }}</td>

                        {{-- KATEGORI (SUDAH FIX) --}}
                        <td>
                            <span class="badge badge-kategori">
                                {{ $item->kategori->nama_kategori ?? '-' }}
                            </span>
                        </td>

                        {{-- FOTO --}}
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" 
                                     alt="Foto Buku" 
                                     style="width: 50px; height: auto; border-radius:6px;">
                            @else
                                <span>-</span>
                            @endif
                        </td>

                        {{-- STOK --}}
                        <td>
                            @if($item->stok > 0)
                                <span class="badge badge-stok-ada">
                                    {{ $item->stok }}
                                </span>
                            @else
                                <span class="badge badge-stok-habis">
                                    Habis
                                </span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td>
                            <div class="action-group">
                                <a href="{{ route('admin.buku.edit', $item->id) }}" class="btn-edit">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('admin.buku.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('Yakin hapus?')">
                                        🗑 Hapus
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:30px; color:#64748b;">
                            📭 Belum ada data buku
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection