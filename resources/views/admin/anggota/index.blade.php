@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    {{-- HEADER --}}
    <div class="page-header">
        <div>
            <h1 class="page-title">📚 Data Anggota</h1>
            <p class="page-subtitle">Kelola data anggota perpustakaan</p>
        </div>

        <a href="{{ url('/admin/anggota/create') }}" class="btn-gold">
            + Tambah anggota
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($anggotas as $i => $a)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $a->nama }}</td>
                        <td>{{ $a->email }}</td>
                        <td>
                            <span class="badge-role {{ $a->role == 'admin' ? 'admin' : 'user' }}">
                                {{ ucfirst($a->role) }}
                            </span>
                        </td>

                        <td>
                            <div class="action-group">

                                <a href="{{ route('admin.anggota.edit', $a->id) }}" class="btn-edit">
                                    ✏️ Edit
                                </a>

                                <form action="{{ route('admin.anggota.destroy', $a->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus anggota ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn-delete">
                                        🗑 Hapus
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center; padding:30px; color:#64748b;">
                            📭 Belum ada data anggota
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection