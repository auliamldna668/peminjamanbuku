<!DOCTYPE html>
<html>
<head>
    <title>App</title>

<link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

   <!-- SIDEBAR -->
<div class="sidebar">

    <h2>
        📚 {{ auth()->user()->role == 'admin' ? 'Admin' : 'User' }}
    </h2>

    @if(auth()->user()->role == 'admin')
         <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
      <a href="{{ route('admin.buku.index') }}">Data Buku</a>
         <a href="{{ route('admin.anggota.index') }}">Data Anggota</a>
        <a href="{{ route('admin.peminjaman.index') }}">Peminjaman</a>
         <a href="{{ route('admin.kategori.index') }}">Kategori</a>
    @else
        <a href="{{ route('user.dashboard') }}">Dashboard</a>
        <a href="{{ route('user.buku.index') }}">Lihat Buku</a>
        <a href="{{ route('user.peminjaman.index') }}">Peminjaman</a>
        <a href="{{ route('pengembalian.index') }}">Pengembalian</a>
    @endif

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">
            Logout
        </button>
    </form>

</div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>