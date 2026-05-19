<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemenang extends Model
{
    protected $fillable = ['barang_lelang_id', 'peserta_lelang_id', 'penawaran_id', 'harga_menang', 'tanggal_menang', 'status_pembayaran'];

    public function barangLelang() { return $this->belongsTo(BarangLelang::class); }
    public function pesertaLelang() { return $this->belongsTo(PesertaLelang::class); }
    public function penawaran() { return $this->belongsTo(Penawaran::class); }
}
