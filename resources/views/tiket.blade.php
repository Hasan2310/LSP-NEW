@extends('components.layout')

@section('title', 'Tiket')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative bg-blue-600 text-white overflow-hidden">
        <div class="relative z-10 px-6 py-20 text-center max-w-4xl mx-auto">
            <h1 class="text-4xl font-bold mb-4">Temukan Tiket Terbaik untuk Perjalananmu!</h1>
            <p class="text-lg">Nikmati perjalanan nyaman dan aman dengan berbagai pilihan maskapai terpercaya.</p>
        </div>
        <!-- Background Image (optional) -->
        <div class="absolute inset-0 opacity-20">
            <img src="https://source.unsplash.com/1600x600/?airplane,sky" alt="Banner" class="w-full h-full object-cover">
        </div>
        <!-- Decorative Wave SVG -->
        <div class="absolute bottom-0 w-full overflow-hidden leading-[0] rotate-180">
            <svg class="relative block w-full h-[60px]" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                viewBox="0 0 1200 120">
                <path
                    d="M0,0V46.29c47.14,22.56,104,33.77,158,28.29,70.22-7.12,136.5-37.23,206-36.71,65.8.5,130,31.91,195,47.84,66.16,16.23,136.26,11.57,200-8.28,56.41-17.41,108.43-46.77,162-63.07V0Z"
                    opacity=".25" class="fill-white"></path>
                <path
                    d="M0,0V15.81C47.14,40,104,55.81,158,50.33c70.22-7.12,136.5-37.23,206-36.71,65.8.5,130,31.91,195,47.84,66.16,16.23,136.26,11.57,200-8.28,56.41-17.41,108.43-46.77,162-63.07V0Z"
                    opacity=".5" class="fill-white"></path>
                <path
                    d="M0,0V5.63C47.14,30,104,49.63,158,44.15c70.22-7.12,136.5-37.23,206-36.71,65.8.5,130,31.91,195,47.84,66.16,16.23,136.26,11.57,200-8.28,56.41-17.41,108.43-46.77,162-63.07V0Z"
                    class="fill-white"></path>
            </svg>
        </div>
    </section>

    <!-- FORM PENCARIAN -->
    <div class="relative z-20 -mt-16 px-4 sm:px-10">
        <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg p-8 sm:p-10 border border-gray-200">
            <form action="{{ route('tiket.index') }}" method="GET"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">

                <!-- Kota Keberangkatan -->
                <div class="space-y-2">
                    <label for="keberangkatan" class="text-sm font-semibold text-gray-700">Kota Keberangkatan</label>
                    <select name="keberangkatan" id="keberangkatan"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 px-3 focus:ring-blue-400 focus:border-blue-500 transition">
                        <option value="">Pilih Kota Keberangkatan</option>
                        @foreach ($kotaKeberangkatan as $kota)
                            <option value="{{ $kota }}" {{ request('keberangkatan') == $kota ? 'selected' : '' }}>
                                {{ $kota }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kota Tujuan -->
                <div class="space-y-2">
                    <label for="tujuan" class="text-sm font-semibold text-gray-700">Kota Tujuan</label>
                    <select name="tujuan" id="tujuan"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 px-3 focus:ring-blue-400 focus:border-blue-500 transition">
                        <option value="">Pilih Kota Tujuan</option>
                        @foreach ($kotaTujuan as $kota)
                            <option value="{{ $kota }}" {{ request('tujuan') == $kota ? 'selected' : '' }}>
                                {{ $kota }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tanggal Keberangkatan -->
                <div class="space-y-2">
                    <label for="tanggal" class="text-sm font-semibold text-gray-700">Tanggal Keberangkatan</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ request('tanggal') }}"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition">
                </div>

                <!-- Kapasitas Kursi -->
                <div class="space-y-2">
                    <label for="kapasitas" class="text-sm font-semibold text-gray-700">Minimal Kapasitas Kursi</label>
                    <input type="number" name="kapasitas" id="kapasitas" min="1" value="{{ request('kapasitas') }}"
                        class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-400 focus:border-blue-500 transition">
                </div>

                <!-- Tombol Aksi -->
                <div class="sm:col-span-2 lg:col-span-1 flex flex-col sm:flex-row gap-4 items-center">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                        Cari Tiket
                    </button>
                    <a href="{{ route('tiket.index') }}"
                        class="w-full text-center bg-gray-200 text-gray-700 py-3 px-6 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>


    <!-- DAFTAR MASKAPAI -->
    <div class="space-y-6 p-6 px-10">
        <h2 class="text-xl font-semibold mb-4">Daftar Maskapai</h2>

        @if ($maskapais->isEmpty())
            <h1 class="text-3xl font-bold text-center text-gray-700">Tiket Tidak Tersedia</h1>
        @else
            <div class="space-y-6">
                @foreach ($maskapais as $maskapai)
                    @if ($maskapai->kapasitas_kursi == 0)
                        @continue
                    @endif

                    <div class="shadow-xl rounded-lg w-full p-5 bg-white">
                        <div class="flex flex-col space-y-4">
                            <div class="flex flex-col sm:flex-row items-center justify-between w-full space-y-4 sm:space-y-0 sm:space-x-4">
                                <!-- Ikon dan nama maskapai -->
                                <div class="flex items-center space-x-3">
                                    @if ($maskapai->foto)
                                        <img src="{{ Storage::url($maskapai->foto) }}" alt="Logo Maskapai" class="w-20 h-12 object-cover rounded-full">
                                    @else
                                        <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-xs text-gray-600">No Image</div>
                                    @endif
                                    <p class="font-semibold text-gray-800">{{ $maskapai->nama_maskapai }}</p>
                                </div>

                                <!-- Jadwal dan kota -->
                                <div class="flex flex-wrap sm:flex-nowrap gap-2 sm:gap-3 items-center justify-center text-sm text-gray-700">
                                    <p>{{ \Carbon\Carbon::parse($maskapai->jam_berangkat)->format('H:i') }} - {{ $maskapai->kota_keberangkatan }}</p>
                                    <p>-</p>
                                    <p>{{ \Carbon\Carbon::parse($maskapai->jam_tiba)->format('H:i') }} - {{ $maskapai->kota_tujuan }}</p>
                                </div>

                                <!-- Harga -->
                                <div class="text-right text-blue-600 font-semibold">
                                    Rp {{ number_format($maskapai->harga_tiket, 0, ',', '.') }}/orang
                                </div>
                            </div>

                            <div class="border-t pt-4 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
                                <!-- Tanggal dan kursi -->
                                <div class="flex gap-6 mb-4 sm:mb-0">
                                    <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($maskapai->tanggal)->format('d-m-Y') }}</p>
                                    <p><strong>Sisa Kursi:</strong> {{ $maskapai->kapasitas_kursi }}</p>
                                </div>

                                <!-- Tombol pesan -->
                                <a href="{{ route('transaksis.create', ['maskapai_id' => $maskapai->id]) }}"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition"
                                    onclick="checkLogin(event, '{{ route('login.index') }}')">
                                    Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>


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
