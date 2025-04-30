<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemesan',
        'email',
        'no_hp',
        'maskapai_id',
        'jumlah_tiket',
        'total_harga',
        'status',
    ];

    public function maskapai()
    {
        return $this->belongsTo(Maskapai::class);
    }
}
