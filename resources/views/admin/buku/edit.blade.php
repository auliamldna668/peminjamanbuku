@extends('layouts.plain')

@section('content')

<div class="page-wrapper">

    <h1>Edit Buku</h1>

    <form action="{{ route('admin.buku.update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Judul</label>
        <input type="text" name="judul" value="{{ $buku->judul }}">

        <label>Penulis</label> {{-- ✅ fix label --}}
        <input type="text" name="penulis" value="{{ $buku->penulis }}"> {{-- ✅ fix name & value --}}

        <label>Kategori</label>
        <select name="kategori_id">
            @foreach($kategoris as $kategori)
                <option value="{{ $kategori->id }}"
                    {{ $buku->kategori_id == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select>

        <label>Stok</label>
        <input type="number" name="stok" value="{{ $buku->stok }}">

        <br><br>

        <button type="submit">Update</button>
    </form>

</div>

@endsection