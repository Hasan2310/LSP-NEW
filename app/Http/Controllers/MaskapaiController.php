<?php

namespace App\Http\Controllers;

use App\Models\Maskapai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class MaskapaiController extends Controller
{
    public function index()
    {
        $maskapais = Maskapai::all();
        return view('dashboard.maskapai.index', compact('maskapais'));
    }

    public function create()
    {
        return view('dashboard.maskapai.create');
    }

    public function store(Request $request)
{
    // Validasi input
    $validated = $request->validate([
        'nama_maskapai' => 'required|string|max:255',
        'kota_keberangkatan' => 'required|string|max:255',
        'kota_tujuan' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'jam_berangkat' => 'required|date_format:H:i',
        'jam_tiba' => 'required|date_format:H:i',
        'harga_tiket' => 'required|numeric',
        'kapasitas_kursi' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif',  // validasi foto
    ]);

    // Menangani upload foto jika ada
    if ($request->hasFile('foto')) {
        // Menyimpan foto langsung ke 'public/' tanpa subfolder
        $fotoPath = $request->file('foto')->store('foto_maskapai', 'public');
    } else {
        $fotoPath = null; // jika tidak ada foto, maka set null
    }


    // Membuat data maskapai baru
    Maskapai::create([
        'nama_maskapai' => $validated['nama_maskapai'],
        'kota_keberangkatan' => $validated['kota_keberangkatan'],
        'kota_tujuan' => $validated['kota_tujuan'],
        'tanggal' => $validated['tanggal'],
        'jam_berangkat' => $validated['jam_berangkat'],
        'jam_tiba' => $validated['jam_tiba'],
        'harga_tiket' => $validated['harga_tiket'],
        'kapasitas_kursi' => $validated['kapasitas_kursi'],
        'foto' => $fotoPath, // simpan path foto
    ]);

    return redirect()->route('maskapais.index')->with('success', 'Maskapai berhasil ditambahkan!');
}


    public function edit($id)
    {
        $maskapai = Maskapai::findOrFail($id);
        return view('dashboard.maskapai.edit', compact('maskapai'));
    }

    public function update(Request $request, $id)
{
    $maskapai = Maskapai::findOrFail($id);

    $validated = $request->validate([
        'nama_maskapai' => 'required|string|max:255',
        'kota_keberangkatan' => 'required|string|max:255',
        'kota_tujuan' => 'required|string|max:255',
        'tanggal' => 'required|date',
        'jam_berangkat' => 'required|date_format:H:i',
        'jam_tiba' => 'required|date_format:H:i',
        'harga_tiket' => 'required|numeric',
        'kapasitas_kursi' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada
        if ($maskapai->foto && Storage::disk('public')->exists($maskapai->foto)) {
            Storage::disk('public')->delete($maskapai->foto);
        }

        // Simpan foto baru
        $fotoPath = $request->file('foto')->store('foto_maskapai', 'public');
    } else {
        $fotoPath = $maskapai->foto;
    }

    $maskapai->update([
        'nama_maskapai' => $validated['nama_maskapai'],
        'kota_keberangkatan' => $validated['kota_keberangkatan'],
        'kota_tujuan' => $validated['kota_tujuan'],
        'tanggal' => $validated['tanggal'],
        'jam_berangkat' => $validated['jam_berangkat'],
        'jam_tiba' => $validated['jam_tiba'],
        'harga_tiket' => $validated['harga_tiket'],
        'kapasitas_kursi' => $validated['kapasitas_kursi'],
        'foto' => $fotoPath,
    ]);

    return redirect()->route('maskapais.index')->with('success', 'Maskapai berhasil diupdate!');
}


    public function destroy($id)
    {
        $maskapai = Maskapai::findOrFail($id);
        $maskapai->delete();
        return redirect()->route('maskapais.index');
    }
    
    public function tiket(Request $request)
    {
        $query = Maskapai::query();

        // Filter berdasarkan keberangkatan jika ada
        if ($request->filled('keberangkatan')) {
            $query->where('kota_keberangkatan', 'like', '%' . $request->keberangkatan . '%');
        }

        // Filter berdasarkan tujuan jika ada
        if ($request->filled('tujuan')) {
            $query->where('kota_tujuan', 'like', '%' . $request->tujuan . '%');
        }

        // Filter berdasarkan tanggal keberangkatan jika ada
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan kapasitas kursi jika ada
        if ($request->filled('kapasitas')) {
            $query->where('kapasitas_kursi', '>=', $request->kapasitas);
        }

        // Ambil hasil query dengan pagination, misalnya 10 per halaman
        $maskapais = $query->paginate(10);

        // Ambil kota keberangkatan dan kota tujuan yang unik
        $kotaKeberangkatan = Maskapai::select('kota_keberangkatan')->distinct()->pluck('kota_keberangkatan');
        $kotaTujuan = Maskapai::select('kota_tujuan')->distinct()->pluck('kota_tujuan');

        return view('tiket', compact('maskapais', 'kotaKeberangkatan', 'kotaTujuan'));
    }


}
