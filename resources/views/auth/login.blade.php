<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ asset('icon.svg') }}" type="image/x-icon"/>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
    <script>
        function togglePassword() {
            const pwInput = document.getElementById('password');
            const eyeOpen = document.getElementById('eye-open');
            const eyeClosed = document.getElementById('eye-closed');

            if (pwInput.type === 'password') {
                pwInput.type = 'text';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            } else {
                pwInput.type = 'password';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            }
        }
    </script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Masuk</h2>

        <!-- Error Handling -->
        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-300 p-3 rounded-lg">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 text-sm text-red-600 bg-red-50 border border-red-300 p-3 rounded-lg">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" id="email" placeholder="you@example.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    required>
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="••••••••"
                        class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required>
                    <div class="absolute right-3 top-3 cursor-pointer" onclick="togglePassword()">
                        <!-- Icon mata terbuka -->
                        <svg id="eye-open" xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-gray-500 hidden" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <!-- Icon mata tertutup -->
                        <svg id="eye-closed" xmlns="http://www.w3.org/2000/svg"
                            class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.965 9.965 0 012.257-3.592M6.383 6.379A9.969 9.969 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.969 9.969 0 01-4.062 4.569M15 12a3 3 0 01-3 3m0 0a3 3 0 01-3-3m3 3L4 4" />
                        </svg>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-300">
                Masuk
            </button>
        </form>
    </div>
</body>
