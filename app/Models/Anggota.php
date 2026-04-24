<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $fillable = [
        'user_id', // ✅ tambah ini
        'nama',
        'email',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // ✅ tambah ini
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class); // ✅ tambah ini
    }
}