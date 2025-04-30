<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<div class="mt-40">
    <div class="max-w-sm mx-auto p-6 border rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 text-center">Masuk</h2>

        <form method="POST" action="{{ route('login.store') }}" class="">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="Email"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" placeholder="Password"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    required>
            </div>

            <!-- Menampilkan pesan error jika login gagal -->
            @if ($errors->any())
                <div class="mb-1 text-red-600 border">
                    <ul class="text-xs">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="submit"
                class="w-full py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                Masuk
            </button>

        </form>
    </div>
</div>
