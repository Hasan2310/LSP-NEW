@extends('components.sidebar')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">

    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Edit User</h2>

    <form action="{{ route('users.update', $user->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Nama -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
        </div>

        <!-- Role -->
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Role</label>
            <select name="role" id="role"
                class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                required>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="maskapai" {{ $user->role == 'maskapai' ? 'selected' : '' }}>Maskapai</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition duration-150 ease-in-out">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
