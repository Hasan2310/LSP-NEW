<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Maskapai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        return view('dashboard.transaksi.index', compact('transaksis'));
    }

    public function create(Request $request)
{
    $maskapai_id = $request->query('maskapai_id');

    // Validasi bahwa maskapai_id tersedia
    if (!$maskapai_id) {
        return redirect()->route('tiket.index')->withErrors('Pilih maskapai terlebih dahulu.');
    }

    $maskapai = Maskapai::findOrFail($maskapai_id);
    return view('create', compact('maskapai'));
}



    public function store(Request $request)
{
    $request->validate([
        'nama_pemesan' => 'required|string|max:255',
        'email' => 'required|email',
        'no_hp' => 'required|string|max:20',
        'maskapai_id' => 'required|exists:maskapais,id',
        'jumlah_tiket' => 'required|integer|min:1',
    ]);

    $maskapai = \App\Models\Maskapai::findOrFail($request->maskapai_id);

    // Cek apakah jumlah kursi cukup
    if ($maskapai->kapasitas_kursi < $request->jumlah_tiket) {
        return back()->withErrors('Jumlah kursi tidak mencukupi.');
    }

    // Hitung total harga
    $total_harga = $maskapai->harga_tiket * $request->jumlah_tiket;

    // Buat transaksi dengan status Pending (default)
    $transaksi = Transaksi::create([
        'nama_pemesan' => $request->nama_pemesan,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'maskapai_id' => $request->maskapai_id,
        'jumlah_tiket' => $request->jumlah_tiket,
        'total_harga' => $total_harga,
        'status' => 'Pending', // Default status
    ]);

    // Hanya kurangi kapasitas kursi jika status transaksi adalah Confirmed
    if ($transaksi->status == 'Confirmed') {
        $maskapai->update([
            'kapasitas_kursi' => $maskapai->kapasitas_kursi - $request->jumlah_tiket
        ]);
    }

    return redirect()->route('transaksis.riwayat')->with('success', 'Transaksi berhasil ditambahkan');
}


    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $maskapais = Maskapai::all();
        return view('dashboard.transaksi.edit', compact('transaksi', 'maskapais'));
    }

//     public function update(Request $request, Transaksi $transaksi)
// {
//     $request->validate([
//         'nama_pemesan' => 'required|string|max:255',
//         'email' => 'required|email',
//         'no_hp' => 'required|string|max:20',
//         'maskapai_id' => 'required|exists:maskapais,id',
//         'jumlah_tiket' => 'required|integer|min:1',
//     ]);

//     $maskapai = \App\Models\Maskapai::findOrFail($request->maskapai_id);

//     // Jika status transaksi sebelumnya adalah 'Confirmed', kita kembalikan kapasitas kursi
//     if ($transaksi->status == 'Confirmed') {
//         $maskapai->kapasitas_kursi += $transaksi->jumlah_tiket;
//         $maskapai->save();
//     }

//     // Cek lagi apakah kapasitas cukup setelah perubahan
//     if ($maskapai->kapasitas_kursi < $request->jumlah_tiket) {
//         return back()->withErrors('Jumlah kursi tidak mencukupi.');
//     }

//     // Hitung total harga baru
//     $total_harga = $maskapai->harga_tiket * $request->jumlah_tiket;

//     // Update transaksi
//     $transaksi->update([
//         'nama_pemesan' => $request->nama_pemesan,
//         'email' => $request->email,
//         'no_hp' => $request->no_hp,
//         'maskapai_id' => $request->maskapai_id,
//         'jumlah_tiket' => $request->jumlah_tiket,
//         'total_harga' => $total_harga,
//     ]);

//     // Hanya kurangi kapasitas kursi jika status transaksi adalah Confirmed
//     if ($transaksi->status == 'Confirmed') {
//         $maskapai->kapasitas_kursi -= $request->jumlah_tiket;
//         $maskapai->save();
//     }

//     return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diupdate');
// }


    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        return redirect()->route('transaksis.riwayat');
    }


    public function riwayat()
    {
        // Mengecek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login.index')->with('error', 'Silakan login untuk melihat riwayat transaksi.');
        }

        $user = Auth::user();

        // Mengambil transaksi milik pengguna yang diurutkan dari yang paling lama
        $transaksis = Transaksi::with('maskapai')
            ->where('nama_pemesan', $user->name)
            ->where('email', $user->email)
            ->oldest() // Menggunakan `oldest()` untuk urutan dari yang paling lama
            ->get();

        // Mengirim data transaksi ke view riwayat
        return view('riwayat', compact('transaksis'));
    }


public function confirmTransaksi($id)
{
    $transaksi = Transaksi::findOrFail($id);

    // Pastikan status transaksi adalah Pending sebelum mengubahnya
    if ($transaksi->status != 'Pending') {
        return back()->withErrors('Transaksi sudah diproses atau sudah dikonfirmasi.');
    }

    // Ambil data maskapai terkait transaksi
    $maskapai = Maskapai::findOrFail($transaksi->maskapai_id);

    // Cek apakah kapasitas kursi cukup untuk jumlah tiket yang dipesan
    if ($maskapai->kapasitas_kursi < $transaksi->jumlah_tiket) {
        return back()->withErrors('Kapasitas kursi tidak mencukupi.');
    }

    // Ubah status transaksi menjadi Confirmed
    $transaksi->update(['status' => 'Confirmed']);

    // Kurangi kapasitas kursi maskapai jika transaksi dikonfirmasi
    $maskapai->update([
        'kapasitas_kursi' => $maskapai->kapasitas_kursi - $transaksi->jumlah_tiket
    ]);

    return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil dikonfirmasi');
}

}
