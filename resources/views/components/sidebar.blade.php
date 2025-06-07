<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="{{ asset('icon.svg') }}" type="image/x-icon"/>
</head>

<body class="bg-gray-100 min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-lg flex flex-col justify-between fixed h-full z-10">
        <div>
            <!-- Logo / Brand -->
            <div class="px-6 py-5 flex items-center space-x-3 border-b border-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-6 h-6 text-blue-600">
                    <path
                        d="M21 5H3a1 1 0 0 0-1 1v3a2 2 0 1 1 0 4v3a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1v-3a2 2 0 1 1 0-4V6a1 1 0 0 0-1-1zm-4 6a1 1 0 0 1-1 1H8a1 1 0 1 1 0-2h8a1 1 0 0 1 1 1z" />
                </svg>

                <h1 class="text-xl font-bold text-blue-600 italic">TFly.</h1>
            </div>

            <!-- Menu Navigation -->
            <nav class="mt-6 px-6 space-y-3">
                <a href="/dashboard"
                    class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition
                        {{ request()->is('dashboard') ? 'bg-blue-100 text-blue-600' : '' }}">
                    Dashboard
                </a>
                <a href="/users"
                    class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition
                        {{ request()->is('users') ? 'bg-blue-100 text-blue-600' : '' }}">
                    Data User
                </a>
                <a href="/maskapais"
                    class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition
                        {{ request()->is('maskapais') ? 'bg-blue-100 text-blue-600' : '' }}">
                    Data Maskapai
                </a>
                <a href="/transaksis"
                    class="block py-2 px-4 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 font-medium transition
                        {{ request()->is('transaksis') ? 'bg-blue-100 text-blue-600' : '' }}">
                    Transaksi
                </a>
            </nav>
        </div>

        <!-- Logout -->
        @auth
            <div class="px-6 pb-6">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full py-2 text-center bg-red-50 text-red-600 border border-red-200 hover:bg-red-500 hover:text-white rounded-lg transition">
                        Logout
                    </button>
                </form>
            </div>
        @endauth
    </aside>

    <!-- Main Content -->
    <main class="ml-64 flex-1 p-6">
        @yield('content')
    </main>

</body>

</html>
