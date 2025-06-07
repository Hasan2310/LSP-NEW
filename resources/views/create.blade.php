@extends('components.layout')

@section('title', 'Pesan Tiket')

@section('content')
<section class="bg-[#2563eb] h-screen flex items-center justify-center">
<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl space-y-6">
    <h2 class="text-3xl font-extrabold text-center text-blue-600">Pesan Tiket: {{ $maskapai->nama_maskapai }}</h2>

    <form method="POST" action="{{ route('transaksis.store') }}" id="checkout-form" class="space-y-5">
        @csrf
        <input type="hidden" name="maskapai_id" value="{{ $maskapai->id }}">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <label for="nama_pemesan" class="block text-sm font-medium text-gray-700">Nama Pemesan</label>
                <input type="text" name="nama_pemesan" value="{{ Auth::user()->name }}" class="w-full border-gray-300 rounded-xl px-4 py-2 bg-gray-100" readonly>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full border-gray-300 rounded-xl px-4 py-2 bg-gray-100" readonly>
            </div>
            <div>
                <label for="no_hp" class="block text-sm font-medium text-gray-700">No HP</label>
                <input type="text" name="no_hp" id="no_hp" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div>
                <label for="jumlah_tiket" class="block text-sm font-medium text-gray-700">Jumlah Tiket</label>
                <input type="number" name="jumlah_tiket" id="jumlah_tiket" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required min="1" max="{{ $maskapai->kapasitas_kursi }}">
            </div>
        </div>

        <div>
            <label for="total_harga" class="block text-sm font-medium text-gray-700">Total Harga</label>
            <input type="text" id="total_harga" name="total_harga" value="Rp 0" class="w-full border-gray-300 rounded-xl px-4 py-2 bg-gray-100 text-gray-700 font-semibold" disabled>
        </div>

        <div id="pesanan-preview" class="hidden p-5 bg-blue-50 border border-blue-200 rounded-xl space-y-2">
            <h3 class="text-lg font-semibold text-blue-700">🧾 Rincian Pesanan</h3>
            <p><strong>Nama Pemesan:</strong> {{ Auth::user()->name }}</p>
            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
            <p><strong>No HP:</strong> <span id="no_hp_preview"></span></p>
            <p><strong>Jumlah Tiket:</strong> <span id="jumlah_tiket_preview"></span></p>
            <p><strong>Total Harga:</strong> <span id="total_harga_preview"></span></p>
        </div>

        <div class="flex flex-col md:flex-row items-center justify-between gap-4 pt-4">
            <button type="button" onclick="showConfirmation()" class="w-full md:w-auto bg-blue-600 text-white px-5 py-2 rounded-xl hover:bg-blue-700 transition-all duration-300">
                👀 Lihat Rincian Pesanan
            </button>
            <button type="submit" id="checkout-button" class="hidden w-full md:w-auto bg-green-600 text-white px-5 py-2 rounded-xl hover:bg-green-700 transition-all duration-300">
                🛒 Checkout
            </button>
        </div>
    </form>
</div>
</section>

<script>
    const hargaTiket = {{ $maskapai->harga_tiket }};
    const jumlahTiketInput = document.getElementById('jumlah_tiket');
    const totalHargaInput = document.getElementById('total_harga');
    const pesananPreview = document.getElementById('pesanan-preview');
    const noHpInput = document.getElementById('no_hp');
    const noHpPreview = document.getElementById('no_hp_preview');
    const jumlahTiketPreview = document.getElementById('jumlah_tiket_preview');
    const totalHargaPreview = document.getElementById('total_harga_preview');

    function updateTotalHarga() {
        const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
        const totalHarga = hargaTiket * jumlahTiket;
        totalHargaInput.value = "Rp " + totalHarga.toLocaleString('id-ID');
    }

    function showConfirmation() {
        const jumlahTiket = parseInt(jumlahTiketInput.value) || 0;
        const totalHarga = hargaTiket * jumlahTiket;
        noHpPreview.textContent = noHpInput.value;
        jumlahTiketPreview.textContent = jumlahTiket;
        totalHargaPreview.textContent = "Rp " + totalHarga.toLocaleString('id-ID');

        pesananPreview.classList.remove('hidden');
        document.getElementById('checkout-button').classList.remove('hidden');
    }

    jumlahTiketInput.addEventListener('input', updateTotalHarga);
    updateTotalHarga();
</script>
@endsection
