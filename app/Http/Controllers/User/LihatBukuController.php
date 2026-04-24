<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Buku;

class LihatBukuController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('user.buku.index', compact('buku'));
    }
}