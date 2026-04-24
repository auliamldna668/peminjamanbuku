@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    
</head>
<body>

    <!-- SIDEBAR -->
    <!-- <div class="sidebar">
        <h2>📚 Admin</h2>

        <a href="/dashboard">Dashboard</a>
        <a href="/buku">Data Buku</a>
        <a href="/anggota">Data Anggota</a>
        <a href="/peminjaman">Peminjaman</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>

    </div> -->

    <!-- CONTENT -->
    <div class="content">
        <h1>Dashboard</h1>

        <div class="card buku">
            <h3>Buku</h3>
            <p><a href="/buku">Lihat Data</a></p>
        </div>

        <div class="card anggota">
            <h3>Anggota</h3>
            <p><a href="/anggota">Lihat Data</a></p>
        </div>

        <div class="card transaksi">
            <h3>Peminjaman</h3>
            <p><a href="/transaksi">Lihat Data</a></p>
        </div>

    </div>

</body>
</html>
@endsection