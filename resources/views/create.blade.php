@extends('components.layout')

@section('title', 'Pesan Tiket')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow-md mt-10">
    <h2 class="text-2xl font-bold mb-4">Pesan Tiket: {{ $maskapai->nama_maskapai }}</h2>
    <form method="POST" action="{{ route('transaksis.store') }}" id="checkout-form">
        @csrf
        <input type="hidden" name="maskapai_id" value="{{ $maskapai->id }}">

        <div class="mb-4">
            <label for="nama_pemesan" class="block text-sm font-medium">Nama Pemesan</label>
            <input type="text" name="nama_pemesan" value="{{ Auth::user()->name }}" class="w-full border rounded px-3 py-2" required readonly>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium">Email</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full border rounded px-3 py-2" required readonly>
        </div>

        <div class="mb-4">
            <label for="no_hp" class="block text-sm font-medium">No HP</label>
            <input type="text" name="no_hp" id="no_hp" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label for="jumlah_tiket" class="block text-sm font-medium">Jumlah Tiket</label>
            <input type="number" name="jumlah_tiket" id="jumlah_tiket" class="w-full border rounded px-3 py-2" required min="1" max="{{ $maskapai->kapasitas_kursi }}">
        </div>

        <!-- Total Harga -->
        <div class="mb-4">
            <label for="total_harga" class="block text-sm font-medium">Total Harga</label>
            <input type="text" id="total_harga" name="total_harga" value="Rp 0" class="w-full border rounded px-3 py-2 bg-gray-200" disabled />
        </div>

        <!-- Preview Pesanan -->
        <div id="pesanan-preview" class="hidden mb-4">
            <h3 class="text-lg font-semibold">Rincian Pesanan</h3>
            <p><strong>Nama Pemesan:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>No HP:</strong> <span id="no_hp_preview"></span></p>
            <p><strong>Jumlah Tiket:</strong> <span id="jumlah_tiket_preview"></span></p>
            <p><strong>Total Harga:</strong> <span id="total_harga_preview"></span></p>
        </div>

        <button type="button" onclick="showConfirmation()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-green-700">
            Lihat Rincian Pesanan
        </button>

        <!-- Button Checkout -->
        <button type="submit" id="checkout-button" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-green-700 mt-4 hidden">
            Checkout
        </button>
    </form>
</div>


<script>
    // Harga tiket dari maskapai
    const hargaTiket = {{ $maskapai->harga_tiket }};

    // Ambil elemen jumlah tiket dan total harga
    const jumlahTiketInput = document.getElementById('jumlah_tiket');
    const totalHargaInput = document.getElementById('total_harga');

    // Preview elemen
    const pesananPreview = document.getElementById('pesanan-preview');
    const noHpInput = document.getElementById('no_hp');
    const noHpPreview = document.getElementById('no_hp_preview');
    const jumlahTiketPreview = document.getElementById('jumlah_tiket_preview');
    const totalHargaPreview = document.getElementById('total_harga_preview');

    // Fungsi untuk menghitung total harga
    function updateTotalHarga() {
        const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
        const totalHarga = hargaTiket * jumlahTiket;
        totalHargaInput.value = "Rp " + totalHarga.toLocaleString('id-ID');
    }

    // Fungsi untuk menampilkan preview pesanan
    function showConfirmation() {
        const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
        const totalHarga = hargaTiket * jumlahTiket;
        noHpPreview.textContent = noHpInput.value; // Ambil nilai dari input no_hp
        jumlahTiketPreview.textContent = jumlahTiket;
        totalHargaPreview.textContent = "Rp " + totalHarga.toLocaleString('id-ID');

        pesananPreview.classList.remove('hidden');
        document.getElementById('checkout-button').classList.remove('hidden');
    }

    // Tambahkan event listener untuk perubahan jumlah tiket
    jumlahTiketInput.addEventListener('input', updateTotalHarga);

    // Inisialisasi total harga saat pertama kali load
    updateTotalHarga();
</script>
@endsection

