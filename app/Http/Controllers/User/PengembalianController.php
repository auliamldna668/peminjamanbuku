<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Anggota;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $anggota = Anggota::where('user_id', Auth::id())->first();

        if (!$anggota) {
            return redirect()->back()->with('error', 'Data anggota tidak ditemukan');
        }

    $peminjamans = Peminjaman::where('anggota_id', $anggota->id)
    ->where('status', 'kembali')
    ->with('buku')
    ->get();

        return view('User.Pengembalian.index', compact('peminjamans'));
    }
}