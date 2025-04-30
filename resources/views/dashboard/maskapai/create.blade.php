@extends('components.sidebar')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">

        <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Tambah Maskapai</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('maskapais.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <!-- dashboard/maskapai/create.blade.php -->

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Foto -->
                    <div>
                        <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Foto Maskapai</label>
                        <input type="file" name="foto" id="foto"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>

                <!-- Nama Maskapai -->
                <div>
                    <label for="nama_maskapai" class="block text-sm font-medium text-gray-700 mb-1">Nama Maskapai</label>
                    <input type="text" name="nama_maskapai" id="nama_maskapai" value="{{ old('nama_maskapai') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>

                <!-- Kota Keberangkatan -->
                <div>
                    <label for="kota_keberangkatan" class="block text-sm font-medium text-gray-700 mb-1">Kota
                        Keberangkatan</label>
                    <input type="text" name="kota_keberangkatan" id="kota_keberangkatan"
                        value="{{ old('kota_keberangkatan') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>

                <!-- Kota Tujuan -->
                <div>
                    <label for="kota_tujuan" class="block text-sm font-medium text-gray-700 mb-1">Kota Tujuan</label>
                    <input type="text" name="kota_tujuan" id="kota_tujuan" value="{{ old('kota_tujuan') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>

                <!-- Tanggal -->
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>

                <!-- Jam Berangkat -->
                <div>
                    <label for="jam_berangkat" class="block text-sm font-medium text-gray-700 mb-1">Jam Berangkat</label>
                    <input type="time" name="jam_berangkat" id="jam_berangkat" value="{{ old('jam_berangkat') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>

                <!-- Jam Tiba -->
                <div>
                    <label for="jam_tiba" class="block text-sm font-medium text-gray-700 mb-1">Jam Tiba</label>
                    <input type="time" name="jam_tiba" id="jam_tiba" value="{{ old('jam_tiba') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required>
                </div>

                <!-- Harga Tiket -->
                <div>
                    <label for="harga_tiket" class="block text-sm font-medium text-gray-700 mb-1">Harga Tiket</label>
                    <input type="number" name="harga_tiket" id="harga_tiket" value="{{ old('harga_tiket') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Harga Tiket" required>
                </div>

                <!-- Kapasitas Kursi -->
                <div>
                    <label for="kapasitas_kursi" class="block text-sm font-medium text-gray-700 mb-1">Kapasitas
                        Kursi</label>
                    <input type="number" name="kapasitas_kursi" id="kapasitas_kursi" value="{{ old('kapasitas_kursi') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        placeholder="Kapasitas Kursi" required>
                </div>

            </div>

            <!-- Tombol Submit -->
            <div class="text-center">
                <button type="submit"
                    class="w-full sm:w-auto bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 transition duration-150 ease-in-out">
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
