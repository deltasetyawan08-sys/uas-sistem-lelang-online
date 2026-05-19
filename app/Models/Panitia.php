<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panitia extends Model
{
    protected $fillable = ['nama_panitia', 'email', 'no_hp', 'jabatan'];
}
