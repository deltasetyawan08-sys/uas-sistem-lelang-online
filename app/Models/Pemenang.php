<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemenang extends Model
{
    protected $fillable = [
        'barang_lelang_id',
        'peserta_lelang_id',
        'penawaran_id',
        'harga_menang',
        'tanggal_menang',
        'status_pembayaran',
    ];

    protected $casts = [
        'harga_menang'   => 'decimal:2',
        'tanggal_menang' => 'date',
    ];

    public function barangLelang()
    {
        return $this->belongsTo(BarangLelang::class);
    }

    public function pesertaLelang()
    {
        return $this->belongsTo(PesertaLelang::class);
    }

    public function penawaran()
    {
        return $this->belongsTo(Penawaran::class);
    }

    /**
     * Accessor: label badge status pembayaran
     */
    public function getLabelStatusAttribute(): string
    {
        return match($this->status_pembayaran) {
            'belum_bayar' => 'Belum Bayar',
            'dp'          => 'DP / Uang Muka',
            'lunas'       => 'Lunas',
            default       => '-',
        };
    }
}