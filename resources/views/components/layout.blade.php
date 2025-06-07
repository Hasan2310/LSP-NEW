<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('icon.svg') }}" type="image/x-icon"/>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .nav-scrolled {
            background-color: #2563eb;
            /* bg-blue-600 */
            transition: background-color 0.3s ease;
        }

        * {
            font-family: "Poppins", sans-serif;
            font-style: normal;
        }
    </style>
</head>

<body class="bg-gray-100 h-screen flex flex-col">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 w-full px-4 py-3 z-50 transition-colors duration-300 ease-in-out">
        <div class="mx-auto flex justify-between items-center container">
            <!-- Logo -->
            <div class="flex items-center space-x-3 justify-center text-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 text-white"
                    viewBox="0 0 24 24">
                    <path
                        d="M21 5H3a1 1 0 0 0-1 1v3a2 2 0 1 1 0 4v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-3a2 2 0 1 1 0-4V6a1 1 0 0 0-1-1zm-4 6a1 1 0 0 1-1 1H8a1 1 0 1 1 0-2h8a1 1 0 0 1 1 1z" />
                </svg>
                <h1 class="font-bold text-white italic">TFly.</h1>
            </div>

            <div class="absolute left-1/2 transform -translate-x-1/2 flex space-x-4 items-center">
                <a href="/"
                    class="text-white transition px-3 py-1 rounded hover:text-blue-600 {{ Request::is('/') ? 'border-b-2 border-white' : '' }}">Home</a>
                <a href="{{ route('tiket.index') }}"
                    class="text-white transition px-3 py-1 rounded hover:text-blue-600 {{ Request::is('tiket*') ? 'border-b-2 border-white' : '' }}">Tiket</a>
                <a href="{{ route('transaksis.riwayat') }}"
                    class="text-white transition px-3 py-1 rounded hover:text-blue-600 {{ Request::is('riwayat') ? 'border-b-2 border-white' : '' }}">Riwayat</a>
            </div>

            @auth
                <!-- Dropdown -->
                <div class="relative group">
                    <button
                        class="flex items-center gap-2 px-4 py-2 bg-white text-black rounded hover:ring hover:ring-blue-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A9 9 0 0112 15a9 9 0 016.879 2.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ Auth::user()->name }}
                    </button>
                    <div
                        class="absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md opacity-0 group-hover:opacity-100 group-hover:visible transition-all duration-300 scale-95 group-hover:scale-100">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block px-4 py-2 text-gray-700 hover:bg-gray-200 w-full text-left rounded-md">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            @endauth

            @guest
                <div>
                    <a href="/login"
                        class="bg-white text-black px-4 py-2 rounded hover:bg-blue-100 hover:text-black transition">
                        Masuk
                    </a>
                </div>
            @endguest
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 z-10">
        @yield('content')
    </div>

    {{-- Footer --}}
    <footer class="bg-[#2563eb] text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm">&copy; {{ date('Y') }} TFly. Semua hak cipta dilindungi.</p>
            <p class="text-sm mt-2">Email: support@tfly.com | Telepon: 0800-123-456</p>
        </div>
    </footer>

    <script>
        const navbar = document.getElementById("navbar");
        window.addEventListener("scroll", () => {
            if (window.scrollY > 50) {
                navbar.classList.add("nav-scrolled");
            } else {
                navbar.classList.remove("nav-scrolled");
            }
        });
    </script>

</body>

</html>
