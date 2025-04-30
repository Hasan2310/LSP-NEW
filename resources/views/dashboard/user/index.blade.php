@extends('components.sidebar')

@section('title', 'Pengguna')
@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

    <h2 class="text-2xl font-bold text-gray-800 mb-6">Daftar Pengguna</h2>

    <a href="{{ route('users.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 mb-6">
        + Tambah User
    </a>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 shadow-md rounded-md overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Nama</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Role</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-t">
                    <td class="px-6 py-4 text-gray-800">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-gray-800">{{ $user->email }}</td>
                    <td class="px-6 py-4 text-gray-800 capitalize">{{ $user->role }}</td>
                    <td class="px-6 py-4 text-gray-800">
                        @if(auth()->id() !== $user->id && $user->role !== 'admin')
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Hapus</button>
                                </form>
                            </div>
                        @else
                            <em class="text-gray-500">Tidak tersedia</em>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
