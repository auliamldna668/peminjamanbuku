@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="page-header">
        <h1 class="page-title">📚 Peminjaman Saya</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div class="table-wrapper">

        <table border="1" width="100%" cellpadding="10">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>  {{-- ✅ kolom denda --}}
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($peminjamans as $key => $pinjam)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $pinjam->buku->judul ?? '-' }}</td>
                        <td>{{ $pinjam->jumlah }}</td>
                        <td>{{ $pinjam->tanggal_pinjam }}</td>
                    <td>{{ $pinjam->tanggal_kembali ?? '-' }}</td>
                        <td>{{ $pinjam->status }}</td>

                        {{-- ✅ Kolom denda --}}
                        <td>
                            @if($pinjam->denda > 0)
                                <span style="color:red; font-weight:bold;">
                                    Rp {{ number_format($pinjam->denda, 0, ',', '.') }}
                                </span>
                            @else
                                <span style="color:green;">-</span>
                            @endif
                        </td>

                        {{-- ✅ Kolom aksi --}}
                        <td>
                            @if($pinjam->status == 'dipinjam')
                                                    <form action="{{ route('user.peminjaman.kembali', $pinjam->id) }}" method="POST">
                        @csrf
                        @method('PATCH') {{-- ✅ tambah ini --}}
                        <button type="submit" onclick="return confirm('Konfirmasi pengembalian buku?')">
                            Kembalikan
                        </button>
                    </form>
                            @elseif($pinjam->status == 'kembali')
                                <span style="color:green;">✅ Sudah dikembalikan</span>
                            @elseif($pinjam->status == 'menunggu')
                                <span style="color:orange;">⏳ Menunggu persetujuan</span>
                            @elseif($pinjam->status == 'ditolak')
                                <span style="color:red;">❌ Ditolak</span>
                            @else
                                <span>-</span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;">
                            Belum ada peminjaman
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection