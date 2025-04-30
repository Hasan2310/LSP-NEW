<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-blue-600 px-4 py-2 shadow-md z-50">
        <div class="mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <div class="flex items-center space-x-3 justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                    <path
                        d="M21 5H3a1 1 0 0 0-1 1v3a2 2 0 1 1 0 4v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-3a2 2 0 1 1 0-4V6a1 1 0 0 0-1-1zm-4 6a1 1 0 0 1-1 1H8a1 1 0 1 1 0-2h8a1 1 0 0 1 1 1z" />
                </svg>
                <h1 class="text-xl font-bold text-white italic">P-Tiket</h1>
            </div>

            <!-- Menu for Authenticated Users -->
            @auth
                <div class="flex-1 flex justify-center space-x-4 items-center">
                    <a href="/"
                        class="text-white hover:text-gray-200
                    {{ request()->is('/') ? 'border-b-2 border-white px-3 py-1' : 'px-3 py-1' }}">
                        Home
                    </a>
                    <a href="{{ route('tiket.index') }}"
                        class="text-white hover:text-gray-200
                    {{ request()->is('tiket*') ? 'border-b-2 border-white px-3 py-1' : 'px-3 py-1' }}">
                        Tiket
                    </a>
                    <a href="{{ route('transaksis.riwayat') }}"
                        class="text-white hover:text-gray-200
                    {{ request()->is('riwayat*') ? 'border-b-2 border-white px-3 py-1' : 'px-3 py-1' }}">
                        Riwayat
                    </a>
                </div>


                <!-- User Menu (Dropdown) -->
                <div class="relative group">
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-white text-black focus:outline-none focus:ring-2 rounded">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A9 9 0 0112 15a9 9 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        {{ Auth::user()->name }}
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out transform scale-95 group-hover:scale-100">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-md w-full text-left">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            <!-- Login Button for Guests -->
            @guest
                <div class="flex items-center gap-2 px-4 py-2 bg-white text-black focus:outline-none focus:ring-2 rounded">
                    <a href="/login" class="text-white hover:text-gray-200">Masuk</a>
                </div>
            @endguest
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 z-10">
        @yield('content')
    </div>

</body>

</html>
