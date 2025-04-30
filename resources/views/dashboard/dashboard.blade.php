@extends('components.sidebar')

@section('title', 'Dashboard')
@section('content')
    <!-- Greeting -->
    <div class="text-start mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Selamat Datang di Dashboard, {{ Auth::user()->name }}</h2>
        <p class="text-lg text-gray-600">Role: <span class="font-semibold text-blue-500">{{ Auth::user()->role }}</span></p>
    </div>

@endsection
