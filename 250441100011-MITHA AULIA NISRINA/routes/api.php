
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BukuController;
use App\Http\Controllers\Api\RekapController;

/*
|--------------------------------------------------------------------------
| API Buku - Akses Membaca
|--------------------------------------------------------------------------
*/

// Menampilkan daftar buku
Route::get('/buku', [BukuController::class, 'index'])
    ->name('api.buku.index');

// Menampilkan detail satu buku
Route::get('/buku/{buku}', [BukuController::class, 'show'])
    ->name('api.buku.show');


/*
|--------------------------------------------------------------------------
| API Buku - Kelola Data Buku
|--------------------------------------------------------------------------
|
| Hanya Admin dan Petugas yang dapat menambah, mengubah,
| dan menghapus data buku.
|
*/

Route::middleware(['web', 'auth', 'can:kelola-buku'])->group(function () {

    // Menambahkan buku
    Route::post('/buku', [BukuController::class, 'store'])
        ->name('api.buku.store');

    // Memperbarui buku
    Route::put('/buku/{buku}', [BukuController::class, 'update'])
        ->name('api.buku.update');

    Route::patch('/buku/{buku}', [BukuController::class, 'update'])
        ->name('api.buku.update.patch');

    // Menghapus buku
    Route::delete('/buku/{buku}', [BukuController::class, 'destroy'])
        ->name('api.buku.destroy');
});


/*
|--------------------------------------------------------------------------
| API Rekap
|--------------------------------------------------------------------------
*/

// Rekap buku berdasarkan kategori
Route::get(
    '/rekap/buku-per-kategori',
    [RekapController::class, 'bukuPerKategori']
)->name('api.rekap.buku-kategori');

// Rekap peminjaman berdasarkan buku
Route::get(
    '/rekap/pemminjaman-per-buku',
    [RekapController::class, 'peminjamanPerBuku']
)->name('api.rekap.peminjaman-buku');
