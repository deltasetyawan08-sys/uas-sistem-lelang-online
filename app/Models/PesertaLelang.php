<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaLelang extends Model
{
    protected $fillable = ['nama_peserta', 'email', 'no_hp', 'alamat', 'status_verifikasi'];
}
