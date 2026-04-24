<?php
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BukuController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\User\PeminjamanController as UserPeminjamanController;
use App\Http\Controllers\User\LihatBukuController;
use App\Http\Controllers\User\PengembalianController;




Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/user/dashboard', function () {
        return view('user.dashboard');
    })->name('user.dashboard');

});



Route::prefix('admin')->name('admin.')->group(function () {

  Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
Route::post('/buku/store', [BukuController::class, 'store'])->name('buku.store');
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');


 Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
Route::post('/anggota/store', [AnggotaController::class, 'store'])->name('anggota.store');
Route::get('/anggota/{id}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
Route::put('/anggota/{id}', [AnggotaController::class, 'update'])->name('anggota.update');
Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

Route::get('/peminjaman', [AdminPeminjamanController::class, 'index'])->name('peminjaman.index');
Route::post('/peminjaman/{id}/approve', [AdminPeminjamanController::class, 'approve'])
    ->name('peminjaman.approve');

Route::post('/peminjaman/{id}/reject', [AdminPeminjamanController::class, 'reject'])
    ->name('peminjaman.reject');
Route::post('/admin/peminjaman/{id}/kembalikan', [AdminPeminjamanController::class, 'kembalikan'])
    ->name('admin.peminjaman.kembalikan');
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');

});

Route::prefix('user')->middleware('auth')->group(function () {

Route::get('/buku', [LihatBukuController::class, 'index'])
    ->name('user.buku.index');

    Route::get('/peminjaman', [UserPeminjamanController::class, 'index'])
        ->name('user.peminjaman.index');

    Route::get('/peminjaman/create/{id}', [UserPeminjamanController::class, 'create'])
        ->name('user.peminjaman.create');

    Route::post('/peminjaman/store', [UserPeminjamanController::class, 'store'])
        ->name('user.peminjaman.store');

    Route::patch('/peminjaman/{id}/kembali', [UserPeminjamanController::class, 'kembali'])
        ->name('user.peminjaman.kembali');

        Route::get('/pengembalian', [PengembalianController::class, 'index'])
    ->name('pengembalian.index');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';