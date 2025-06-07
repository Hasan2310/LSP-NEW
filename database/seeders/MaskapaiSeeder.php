<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Maskapai;

class MaskapaiSeeder extends Seeder
{
    public function run(): void
    {
        $maskapais = [
            [
                'nama_maskapai' => 'Garuda Indonesia',
                'kota_keberangkatan' => 'Jakarta',
                'kota_tujuan' => 'Bali',
                'tanggal' => '2025-06-15',
                'jam_berangkat' => '08:00:00',
                'jam_tiba' => '10:00:00',
                'harga_tiket' => 1200000,
                'kapasitas_kursi' => 150,
                'foto' => 'foto_maskapai/garuda.jpg',
            ],
            [
                'nama_maskapai' => 'Lion Air',
                'kota_keberangkatan' => 'Surabaya',
                'kota_tujuan' => 'Makassar',
                'tanggal' => '2025-06-16',
                'jam_berangkat' => '13:30:00',
                'jam_tiba' => '15:45:00',
                'harga_tiket' => 950000,
                'kapasitas_kursi' => 180,
                'foto' => 'foto_maskapai/lionair.jpg',
            ],
            [
                'nama_maskapai' => 'AirAsia',
                'kota_keberangkatan' => 'Medan',
                'kota_tujuan' => 'Jakarta',
                'tanggal' => '2025-06-17',
                'jam_berangkat' => '09:00:00',
                'jam_tiba' => '11:30:00',
                'harga_tiket' => 1100000,
                'kapasitas_kursi' => 160,
                'foto' => 'foto_maskapai/airasia.jpg',
            ],
            [
                'nama_maskapai' => 'Citilink',
                'kota_keberangkatan' => 'Bandung',
                'kota_tujuan' => 'Yogyakarta',
                'tanggal' => '2025-06-18',
                'jam_berangkat' => '07:45:00',
                'jam_tiba' => '09:00:00',
                'harga_tiket' => 700000,
                'kapasitas_kursi' => 100,
                'foto' => 'foto_maskapai/citilink.jpg',
            ],
            [
                'nama_maskapai' => 'Sriwijaya Air',
                'kota_keberangkatan' => 'Pontianak',
                'kota_tujuan' => 'Batam',
                'tanggal' => '2025-06-19',
                'jam_berangkat' => '14:15:00',
                'jam_tiba' => '16:00:00',
                'harga_tiket' => 850000,
                'kapasitas_kursi' => 140,
                'foto' => 'foto_maskapai/sriwijaya.jpg',
            ],
        ];

        foreach ($maskapais as $maskapai) {
            Maskapai::create($maskapai);
        }
    }
}
