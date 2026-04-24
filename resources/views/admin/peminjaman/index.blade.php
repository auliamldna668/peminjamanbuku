@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">📚 Data Peminjaman</h1>
            <p class="page-subtitle">Kelola approval peminjaman buku</p>
        </div>
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

            {{-- HEADER TABLE --}}
            <thead>
                <tr>
                    <th>Anggota</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Denda</th> {{-- ✅ tambah --}}
                    <th>Status</th>
                </tr>
            </thead>

            {{-- BODY --}}
            <tbody>
                @forelse($peminjamans as $p)
                    <tr>

                        <td>{{ $p->anggota->nama ?? '-' }}</td>

                        <td>{{ $p->buku->judul ?? '-' }}</td>

                        <td>{{ $p->tanggal_pinjam }}</td>

                        <td>{{ $p->tanggal_kembali ?? '-' }}</td>

                        {{-- ✅ kolom denda --}}
                        <td>
                            @if($p->denda > 0)
                                <span style="color:red; font-weight:bold;">
                                    Rp {{ number_format($p->denda, 0, ',', '.') }}
                                </span>
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if($p->status == 'menunggu')

                                <form action="{{route('admin.peminjaman.approve', $p->id)}}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-approve">
                                        ✅ Setujui
                                    </button>
                                </form>

                                <form action="{{ route('admin.peminjaman.reject', $p->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn-delete">
                                        ❌ Tolak
                                    </button>
                                </form>

                            @elseif($p->status == 'dipinjam')
                                <span class="badge badge-stok-ada">
                                    Disetujui
                                </span>

                            @elseif($p->status == 'kembali')
                                <span class="badge badge-stok-ada">
                                    ✅ Sudah Kembali
                                </span>

                            @else
                                <span class="badge badge-stok-habis">
                                    Ditolak
                                </span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; padding:30px;">
                            📭 Belum ada data peminjaman
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection