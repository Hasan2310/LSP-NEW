@extends('components.layout')

@section('title', 'Tiket')

@section('content')
<div class="space-y-6 p-6 px-10">
    <h2 class="text-xl font-semibold mb-4">Daftar Maskapai</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($maskapais as $maskapai)
            @if ($maskapai->kapasitas_kursi == 0)
                @continue
            @endif

            <div class="bg-white rounded-xl shadow-md overflow-hidden border text-sm">
                <div class="grid grid-cols-1 sm:grid-cols-2">
                    {{-- Gambar --}}
                    <div class="h-full">
                        @if($maskapai->foto)
                            <img src="{{ Storage::url($maskapai->foto) }}"
                                 alt="Foto Maskapai"
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-500">
                                Tidak ada gambar
                            </div>
                        @endif
                    </div>

                    {{-- Informasi --}}
                    <div class="p-4 flex flex-col justify-between">
                        <div>
                            <h3 class="text-base font-semibold text-gray-800 mb-2">
                                {{ $maskapai->nama_maskapai }}
                            </h3>

                            <div class="text-gray-700 space-y-1">
                                <p><strong>Dari:</strong> {{ $maskapai->kota_keberangkatan }}</p>
                                <p><strong>Tujuan:</strong> {{ $maskapai->kota_tujuan }}</p>
                                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($maskapai->tanggal)->format('d-m-Y') }}</p>
                                <p><strong>Jam:</strong> {{ \Carbon\Carbon::parse($maskapai->jam_berangkat)->format('H:i') }} - {{ \Carbon\Carbon::parse($maskapai->jam_tiba)->format('H:i') }}</p>
                                <p><strong>Harga:</strong> Rp {{ number_format($maskapai->harga_tiket, 0, ',', '.') }}</p>
                                <p><strong>Sisa Kursi:</strong> {{ $maskapai->kapasitas_kursi }}</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <a href="{{ route('transaksis.create', ['maskapai_id' => $maskapai->id]) }}"
                               class="inline-block bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded text-center w-full">
                                Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
