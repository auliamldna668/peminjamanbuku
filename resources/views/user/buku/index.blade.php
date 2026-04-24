@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">📚 Daftar Buku</h1>
            <p class="page-subtitle">Pilih buku untuk dipinjam</p>
        </div>
    </div>

    {{-- TABLE WRAPPER --}}
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
                @forelse($buku as $i => $b)
                    <tr>
                        <td>{{ $i + 1 }}</td>

                        <td>
                            <div class="book-title-cell">
                                {{ $b->judul }}
                            </div>
                        </td>

                        {{-- PENGARANG --}}
                        <td>{{ $b->penulis ?? '-' }}</td> {{-- ✅ fix --}}

                        {{-- KATEGORI --}}
                        <td>
                            <span class="badge badge-kategori">
                                {{ $b->kategori->nama_kategori ?? '-' }} {{-- ✅ fix --}}
                            </span>
                        </td>

                        <td>
                            @if($b->foto)
                                <img src="{{ asset('storage/' . $b->foto) }}" 
                                     style="width:50px; height:auto;">
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if($b->stok > 0)
                                <span class="badge badge-stok-ada">
                                    {{ $b->stok }}
                                </span>
                            @else
                                <span class="badge badge-stok-habis">
                                    Habis
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($b->stok > 0)
                                <a href="{{ url('/user/peminjaman/create/' . $b->id) }}">
                                    📖 Pinjam
                                </a>
                            @else
                                <span class="btn-delete" style="opacity:0.6; cursor:not-allowed;">
                                    Tidak Tersedia
                                </span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:30px;">
                            📭 Belum ada buku
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection