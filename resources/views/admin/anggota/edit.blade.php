@extends('layouts.plain')

@section('content')

<div class="page-wrapper">

    <div class="page-header">
        <h1 class="page-title">✏️ Edit Anggota</h1>
    </div>

    <div class="form-wrapper">

        <form action="{{ route('admin.anggota.update', $anggota->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- NAMA --}}
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ $anggota->nama }}" required>
            </div>

            {{-- EMAIL --}}
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ $anggota->email }}" required>
            </div>

            {{-- ROLE --}}
            <div class="form-group">
                <label>Role</label>
                <select name="role" required>
                    <option value="admin" {{ $anggota->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="anggota" {{ $anggota->role == 'anggota' ? 'selected' : '' }}>Anggota</option>
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="form-group">
                <button type="submit" class="btn-gold">
                    💾 Update
                </button>
            </div>

        </form>

    </div>

</div>

@endsection