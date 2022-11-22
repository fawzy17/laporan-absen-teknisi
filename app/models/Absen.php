<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    protected $fillable = [
        'nip_karyawan',
        'nama_karyawan',
        'latitude',
        'longitude',
        'kode_mesin',
        'kondisi_mesin',
        'foto',
    ];
    use HasFactory;
}
