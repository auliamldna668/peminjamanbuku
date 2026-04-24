@extends('layouts.app')

@section('content')

<div class="content">
    <h1>Dashboard</h1>

    <div class="card buku">
        <h3>Buku</h3>
       <a href="{{ route('user.buku.index') }}">Lihat Buku</a>
    </div>

    <div class="card peminjaman">
        <h3>Peminjaman saya</h3>
        <p><a href="{{ route('user.peminjaman.index') }}">Lihat Peminjaman</a></p>
    </div>

    <div class="card pengembalian">
        <h3>Pengembalian</h3>
        <p><a href="{{ route('pengembalian.index') }}">Lihat Pengembalian</a></p>
    </div>

   

</div>

@endsection