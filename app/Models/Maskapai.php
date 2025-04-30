<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maskapai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_maskapai',
        'kota_keberangkatan',
        'kota_tujuan',
        'tanggal',
        'jam_berangkat',
        'jam_tiba',
        'harga_tiket',
        'kapasitas_kursi',
        'foto',  
    ];

}
