@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="page-header">
        <h1 class="page-title">📚 Pengembalian Saya</h1>
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
                    <th>Denda</th> {{-- ✅ tambah kolom denda --}}
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
                        <td>{{ $pinjam->tanggal_kembali_rencana ?? '-' }}</td> {{-- ✅ fix nama kolom --}}
                        <td>{{ $pinjam->status }}</td>

                        {{-- ✅ kolom denda --}}
                        <td>
                            @if($pinjam->denda > 0)
                                Rp {{ number_format($pinjam->denda, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>

                        <td>
                            @if($pinjam->status == 'dipinjam')
                                <form action="{{ url('user/peminjaman/' . $pinjam->id . '/kembali') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">
                                        Kembalikan
                                    </button>
                                </form>
                            @else
                                        <form action="{{ route('user.peminjaman.kembali', $pinjam->id) }}" method="POST">
                      
                    
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align:center;"> {{-- ✅ colspan jadi 8 --}}
                            Belum ada peminjaman
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection