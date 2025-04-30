@extends('components.sidebar')

@section('title', 'Transaksi')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Transaksi</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-md overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nama Pemesan</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">No HP</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Maskapai</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Jumlah Tiket</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Total Harga</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Status</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                    <tr class="border-t">
                        <td class="px-6 py-4 text-gray-800">{{ $transaksi->nama_pemesan }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $transaksi->email }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $transaksi->no_hp }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $transaksi->maskapai->nama_maskapai }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $transaksi->jumlah_tiket }}</td>
                        <td class="px-6 py-4 text-gray-800">Rp. {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $transaksi->status }}</td>
                        <td class="px-6 py-4 text-gray-800">
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" onsubmit="return confirm('Yakin hapus transaksi ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>

                                <!-- Tombol Konfirmasi, tampilkan hanya jika status transaksi Pending dan user adalah admin -->
                                @if ($transaksi->status === 'Pending' && auth()->user()->role === 'admin')
                                    <form action="{{ route('transaksis.confirm', $transaksi->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:underline">Konfirmasi</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
