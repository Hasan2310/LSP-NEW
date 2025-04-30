@extends('components.layout')

@section('title', 'Riwayat Transaksi')

@section('content')
<div class="space-y-6 py-6 px-10">
    <h2 class="text-xl font-semibold mb-4">Riwayat Transaksi</h2>

    @if($transaksis->isEmpty())
        <p class="text-gray-600">Belum ada transaksi.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($transaksis as $transaksi)
                <div class="bg-white rounded-xl shadow-md overflow-hidden border text-sm">
                    <div class="grid grid-cols-2">
                        {{-- Gambar --}}
                        <div class="h-full">
                            @if($transaksi->maskapai->foto)
                                <img src="{{ Storage::url($transaksi->maskapai->foto) }}"
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
                                <h3 class="text-base font-semibold text-gray-800 mb-2">Pesanan #{{ $loop->iteration }}</h3>

                                <div class="text-gray-700 space-y-1 mb-3">
                                    <p><strong>Nama:</strong> {{ $transaksi->nama_pemesan }}</p>
                                    <p><strong>Email:</strong> {{ $transaksi->email }}</p>
                                    <p><strong>No HP:</strong> {{ $transaksi->no_hp }}</p>
                                </div>

                                <div class="text-gray-700 space-y-1 mb-3">
                                    <p><strong>Maskapai:</strong> {{ $transaksi->maskapai->nama_maskapai }}</p>
                                    <p><strong>Jumlah:</strong> {{ $transaksi->jumlah_tiket }}</p>
                                    <p><strong>Total:</strong> Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            {{-- Status Transaksi dengan warna berdasarkan status --}}
                            <div class="mt-4">
                                @if($transaksi->status == 'Pending')
                                    <span class="inline-block px-3 py-1 text-xs rounded-full bg-orange-400 text-white">
                                        Status: Pending
                                    </span>

                                    {{-- Button Batalkan Transaksi --}}
                                    <div class="mt-3 flex justify-between items-center">
                                        <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" class="w-full" id="cancel-form-{{ $transaksi->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmCancellation({{ $transaksi->id }})" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                                                Batalkan Transaksi
                                            </button>
                                        </form>
                                    </div>

                                @elseif($transaksi->status == 'Confirmed')
                                    <span class="inline-block px-3 py-1 text-xs rounded-full bg-green-600 text-white">
                                        Status: Confirmed
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 text-xs rounded-full bg-gray-200 text-gray-800">
                                        Status: {{ ucfirst($transaksi->status) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<script>
    function confirmCancellation(transaksiId) {
        const confirmation = confirm("Apakah Anda yakin ingin membatalkan transaksi ini?");
        if (confirmation) {
            document.getElementById('cancel-form-' + transaksiId).submit();
        }
    }
</script>
@endsection
