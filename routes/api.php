<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangLelangController;
use App\Http\Controllers\PesertaLelangController;
use App\Http\Controllers\PanitiaController;
use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\PemenangController;

Route::apiResource('barang-lelang', BarangLelangController::class);
Route::apiResource('peserta-lelang', PesertaLelangController::class);
Route::apiResource('panitia', PanitiaController::class);
Route::apiResource('penawaran', PenawaranController::class);
Route::apiResource('pemenang', PemenangController::class);

// Route khusus modul pemenang: tetapkan pemenang otomatis dari penawaran tertinggi
Route::post('pemenang/tetapkan-otomatis', [PemenangController::class, 'tetapkanOtomatis']);