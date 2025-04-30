@extends('components.layout')
@section('title', 'Beranda')

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-cover bg-center relative" style="background-image: url('Pesawat.jpg');">
    <!-- Overlay Gelap -->
    <div class="absolute inset-0 bg-black opacity-50"></div>

    <div class="relative text-center z-10">
        @auth
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Selamat Datang, {{ Auth::user()->name }}!
            </h1>
            <p class="text-xl text-gray-200 mb-8">Role Anda: <span class="font-semibold">{{ Auth::user()->role }}</span></p>

            <div class="flex justify-center space-x-4">
                @if(Auth::user()->role === 'user')
                    <a href="{{ route('tiket.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow">
                        Pesan Tiket
                    </a>
                @elseif(Auth::user()->role === 'admin' || Auth::user()->role === 'maskapai')
                    <a href="/dashboard" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg shadow">
                        Dashboard Admin
                    </a>
                @endif
            </div>
        @endauth

        @guest
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                Selamat Datang di P-Tiket
            </h1>
            <p class="text-lg text-gray-200 mb-8">
                Pesan tiket pesawat dengan mudah dan cepat.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="/login" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow">
                    Masuk
                </a>
            </div>
        @endguest
    </div>
</div>
@endsection
