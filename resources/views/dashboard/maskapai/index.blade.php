@extends('components.sidebar')

@section('title', 'Maskapai')
@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Data Maskapai</h2>

    <a href="{{ route('maskapais.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-6">
        + Tambah Data Maskapai
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-md overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Foto</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nama Maskapai</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Kota Keberangkatan</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Kota Tujuan</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Tanggal</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Jam Berangkat</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Jam Tiba</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Harga Tiket</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Kapasitas Kursi</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maskapais as $maskapai)
                    <tr class="border-t">
                        <td class="px-6 py-4 text-gray-800">
                            @if($maskapai->foto)
                            <img src="{{ asset('storage/' . $maskapai->foto) }}" alt="Foto Maskapai" class="w-10 h-10 object-cover">
                            @else
                                <span>No Foto</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-800">{{ $maskapai->nama_maskapai }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $maskapai->kota_keberangkatan }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $maskapai->kota_tujuan }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $maskapai->tanggal }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ \Carbon\Carbon::parse($maskapai->jam_berangkat)->format('H:i') }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ \Carbon\Carbon::parse($maskapai->jam_tiba)->format('H:i') }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ number_format($maskapai->harga_tiket, 0, ',', '.') }}</td>
                        <td class="px-6 py-4 text-gray-800">{{ $maskapai->kapasitas_kursi }}</td>
                        <td class="px-6 py-4 text-gray-800">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('maskapais.edit', $maskapai->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('maskapais.destroy', $maskapai->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
