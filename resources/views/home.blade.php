@extends('components.layout')
@section('title', 'Beranda')

@section('content')
{{-- Hero Section --}}
<section class="h-screen flex items-center justify-between bg-cover bg-center relative px-6" style="background-image: url('Pesawat.jpg');">
    <div class="absolute inset-0 bg-black opacity-25"></div>
    <div class="relative flex w-full justify-between container mx-auto">
        <div class="text-left text-white z-10">
            @auth
                <h1 class="text-5xl md:text-lg  tracking-tight">
                    Selamat Datang di TFly.
                </h1>
                <p class="text-6xl font-bold leading-snug mb-3">
                    Solusi terbaik untuk tiket Pesawat Anda.
                </p>
                <div class="flex justify-start space-x-4">
                    @if(Auth::user()->role === 'user')
                        <a href="{{ route('tiket.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105">
                            Pesan Tiket
                        </a>
                    @elseif(Auth::user()->role === 'admin' || Auth::user()->role === 'maskapai')
                        <a href="/dashboard" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105">
                            Dashboard
                        </a>
                    @endif
                </div>
            @endauth

            @guest
                <h1 class="text-5xl md:text-lg  tracking-tight">
                    Selamat Datang di TFly.
                </h1>
                <p class="text-6xl font-bold leading-snug mb-3">
                    Solusi terbaik untuk tiket Pesawat Anda.
                </p>
                <a href="/tiket" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition-all duration-300 ease-in-out transform hover:scale-105">
                    Cari tiket
                </a>
            @endguest
        </div>
        <!-- Kolom kanan kosong -->
        <div class="w-1/2"></div>
    </div>
</section>

{{-- Destinasi Populer --}}
<section class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-10">Destinasi Populer</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="bali.jpg" alt="Bali" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">Bali</h3>
                    <p class="text-gray-600">Nikmati liburan tropis di pulau dewata dengan penerbangan hemat.</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="jakarta.jpg" alt="Jakarta" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">Jakarta</h3>
                    <p class="text-gray-600">Kunjungi ibu kota Indonesia dengan akses mudah dan cepat.</p>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="yogyakarta.jpg" alt="Yogyakarta" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-xl font-semibold mb-2">Yogyakarta</h3>
                    <p class="text-gray-600">Jelajahi budaya dan keindahan alam Yogyakarta dengan harga tiket terjangkau.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Cara Memesan Tiket --}}
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-10">Cara Memesan Tiket</h2>
        <div class="grid md:grid-cols-3 gap-8 text-left">
            <div class="bg-gray-100 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">1. Pilih Rute & Tanggal</h3>
                <p class="text-gray-700">Masukkan kota keberangkatan dan tujuan, lalu pilih tanggal penerbangan yang Anda inginkan.</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">2. Isi Data Penumpang</h3>
                <p class="text-gray-700">Lengkapi informasi penumpang sesuai identitas resmi yang berlaku.</p>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg shadow">
                <h3 class="text-xl font-semibold mb-2">3. Lakukan Pembayaran</h3>
                <p class="text-gray-700">Pilih metode pembayaran dan selesaikan transaksi Anda dengan aman.</p>
            </div>
        </div>
    </div>
</section>

{{-- Kenapa Memilih TFly --}}
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-8">Kenapa Memilih TFly?</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <div>
                <div class="text-5xl text-blue-500 mb-3">⚡</div>
                <h3 class="text-xl font-semibold mb-2">Cepat & Praktis</h3>
                <p class="text-gray-600">Proses pemesanan yang mudah, hanya dalam hitungan menit.</p>
            </div>
            <div>
                <div class="text-5xl text-green-500 mb-3">🔒</div>
                <h3 class="text-xl font-semibold mb-2">Pembayaran Aman</h3>
                <p class="text-gray-600">Sistem transaksi kami dilengkapi dengan keamanan tingkat tinggi.</p>
            </div>
            <div>
                <div class="text-5xl text-yellow-500 mb-3">📞</div>
                <h3 class="text-xl font-semibold mb-2">Layanan 24/7</h3>
                <p class="text-gray-600">Tim support kami siap membantu kapan pun Anda butuh.</p>
            </div>
        </div>
    </div>
</section>

<script>
    function checkLogin(event, loginUrl) {
        // Cek apakah pengguna sudah login
        @auth
            // Jika sudah login, biarkan tombol berfungsi
            return true;
        @else
            // Jika belum login, tampilkan alert dan arahkan ke halaman login
            event.preventDefault(); // Mencegah tindakan default (pergi ke halaman pemesanan)
            alert('Silakan login terlebih dahulu untuk memesan tiket.');
            window.location.href = loginUrl; // Mengarahkan ke halaman login
            return false;
        @endauth
    }
</script>
@endsection
