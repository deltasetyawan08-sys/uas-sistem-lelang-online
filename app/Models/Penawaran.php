<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penawaran extends Model
{
    protected $fillable = ['barang_lelang_id', 'peserta_lelang_id', 'nominal_bid', 'waktu_bid', 'status_bid'];

    public function barangLelang() { return $this->belongsTo(BarangLelang::class); }
    public function pesertaLelang() { return $this->belongsTo(PesertaLelang::class); }
}
