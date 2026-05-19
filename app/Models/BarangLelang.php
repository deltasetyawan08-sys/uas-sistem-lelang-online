<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BarangLelang extends Model
{
    protected $fillable = ['nama_barang', 'deskripsi', 'harga_awal', 'status', 'tanggal_mulai', 'tanggal_selesai'];
}
