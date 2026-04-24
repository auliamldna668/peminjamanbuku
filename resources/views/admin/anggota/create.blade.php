@extends('layouts.app')

@section('content')
<div class="page-wrapper">

    <h1 class="page-title">Tambah Anggota</h1>
    <p class="page-subtitle">Tambah data anggota baru</p>

    <div class="form-card" style="margin-top:20px;">

        <form action="/admin/anggota/store" method="POST">
            @csrf

            <!-- Nama -->
            <div class="form-group">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-input" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" required>
            </div>

        
            <!-- Role -->
            <div class="form-group">
                <label class="form-label">Role</label>
                <select name="role" class="form-input" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="Anggota">Anggota</option>
                </select>
            </div>

            <!-- Password -->
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" required>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-gold">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>
@endsection