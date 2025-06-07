@extends('components.layout')

@section('title', 'Riwayat Transaksi')

@section('content')
<!-- HERO BANNER RIWAYAT -->
<section class="relative bg-blue-600 text-white overflow-hidden">
    <div class="relative z-10 px-6 py-20 text-center max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold mb-4">Riwayat Transaksi Tiketmu</h1>
        <p class="text-lg">Cek status dan detail pemesanan perjalananmu di sini.</p>
    </div>
    <div class="absolute inset-0 opacity-20">
        <img src="https://source.unsplash.com/1600x600/?travel,boardingpass" alt="Riwayat" class="w-full h-full object-cover">
    </div>
    <div class="absolute bottom-0 w-full overflow-hidden leading-[0]">
        <svg class="relative block w-full h-[100px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" preserveAspectRatio="none">
          <path fill="#ffffff" fill-opacity="0.3" d="M0,192L48,181.3C96,171,192,149,288,160C384,171,480,213,576,229.3C672,245,768,235,864,208C960,181,1056,139,1152,122.7C1248,107,1344,117,1392,122.7L1440,128V320H0Z"></path>
          <path fill="#ffffff" fill-opacity="0.6" d="M0,224L48,213.3C96,203,192,181,288,170.7C384,160,480,160,576,176C672,192,768,224,864,229.3C960,235,1056,213,1152,202.7C1248,192,1344,192,1392,192L1440,192V320H0Z"></path>
          <path fill="#ffffff" fill-opacity="1" d="M0,256L48,250.7C96,245,192,235,288,224C384,213,480,203,576,197.3C672,192,768,192,864,202.7C960,213,1056,235,1152,240C1248,245,1344,235,1392,229.3L1440,224V320H0Z"></path>
        </svg>
      </div>
</section>

<!-- RIWAYAT TRANSAKSI LIST -->
<div class="space-y-6 p-6 px-10">
    <h2 class="text-xl font-semibold mb-4">Daftar Transaksi</h2>

    @if ($transaksis->isEmpty())
        <h1 class="text-3xl font-bold text-center text-gray-700">Belum ada transaksi</h1>
    @else
        <div class="space-y-6">
            @foreach ($transaksis as $transaksi)
                <div class="shadow-xl rounded-lg w-full p-5 bg-white">
                    <div class="flbex flex-col space-y-4">
                        <div class="flex flex-col sm:flex-row items-center justify-between w-full space-y-4 sm:space-y-0 sm:space-x-4">
                            <!-- Info Maskapai -->
                            <div class="flex items-center space-x-3">
                                @if ($transaksi->maskapai->foto)
                                    <img src="{{ Storage::url($transaksi->maskapai->foto) }}" alt="Logo Maskapai" class="w-12 h-12 object-cover rounded-full">
                                @else
                                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center text-xs text-gray-600">No Image</div>
                                @endif
                                <p class="font-semibold text-gray-800">{{ $transaksi->maskapai->nama_maskapai }}</p>
                            </div>

                            <!-- Waktu & Rute -->
                            <div class="flex flex-wrap sm:flex-nowrap gap-2 sm:gap-3 items-center justify-center text-sm text-gray-700">
                                <p>{{ \Carbon\Carbon::parse($transaksi->maskapai->jam_berangkat)->format('H:i') }} - {{ $transaksi->maskapai->kota_keberangkatan }}</p>
                                <p>-</p>
                                <p>{{ \Carbon\Carbon::parse($transaksi->maskapai->jam_tiba)->format('H:i') }} - {{ $transaksi->maskapai->kota_tujuan }}</p>
                            </div>

                            <!-- Harga Tiket -->
                            <div class="text-right text-blue-600 font-semibold">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </div>
                        </div>

                        <!-- Detail Tanggal & Status -->
                        <div class="border-t pt-4 flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
                            <div class="flex gap-6 mb-4 sm:mb-0">
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($transaksi->maskapai->tanggal)->format('d-m-Y') }}</p>
                                <p><strong>Jumlah Tiket:</strong> {{ $transaksi->jumlah_tiket }}</p>
                                <p><strong>Status:</strong>
                                    <span class="font-semibold {{ $transaksi->status == 'Confirmed' ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $transaksi->status }}
                                    </span>
                                </p>
                            </div>

                            <!-- Aksi atau info tambahan -->
                            <a href="#" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
