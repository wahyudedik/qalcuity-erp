@extends('layouts.app')

@section('title', 'Detail Cabang')

@section('breadcrumb')
<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <a href="{{ route('branches.index') }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">Cabang</a>
            </div>
        </li>
        <li aria-current="page">
            <div class="flex items-center">
                <svg class="w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400">{{ $branch->name }}</span>
            </div>
        </li>
    </ol>
</nav>
@endsection

@section('page-title', $branch->name)
@section('page-subtitle', 'Detail informasi cabang dan pengguna')

@section('content')
    <div class="mb-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            @if($branch->is_active)
                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-md dark:bg-green-900 dark:text-green-300">
                    Aktif
                </span>
            @else
                <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-md dark:bg-red-900 dark:text-red-300">
                    Tidak Aktif
                </span>
            @endif
            <span class="text-sm text-gray-500 dark:text-gray-400">Kode: {{ $branch->code }}</span>
        </div>
        
        <div class="flex items-center space-x-2">
            <a href="{{ route('branches.edit', $branch->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-4 h-4 mr-1 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"></path>
                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd"></path>
                </svg>
                Edit
            </a>
            <a href="{{ route('branches.assign', $branch->id) }}" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-purple-600 dark:hover:bg-purple-700 focus:outline-none dark:focus:ring-purple-800">
                <svg class="w-4 h-4 mr-1 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                </svg>
                Kelola Pengguna
            </a>
            <form action="{{ route('branches.destroy', $branch->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus cabang ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                    <svg class="w-4 h-4 mr-1 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <!-- Branch Information -->
    <div class="grid grid-cols-1 gap-4 xl:grid-cols-2">
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Informasi Cabang</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Nama Cabang</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->name }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Kode Cabang</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->code }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</h4>
                    <p class="text-base font-semibold">
                        @if ($branch->is_active)
                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Aktif</span>
                        @else
                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Tidak Aktif</span>
                        @endif
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Manager</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->manager_name ?? 'Belum ditentukan' }}</p>
                </div>
                <div class="col-span-2">
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->address ?? 'Tidak ada alamat' }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Kota</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->city ?? 'Tidak diketahui' }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Provinsi</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->province ?? 'Tidak diketahui' }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Kode Pos</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->postal_code ?? 'Tidak diketahui' }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Telepon</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->phone ?? 'Tidak diketahui' }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->email ?? 'Tidak diketahui' }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Dibuat Pada</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
        </div>

        <!-- Location & Map -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Lokasi</h3>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Latitude</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->latitude ?? 'Tidak diketahui' }}</p>
                </div>
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400">Longitude</h4>
                    <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $branch->longitude ?? 'Tidak diketahui' }}</p>
                </div>
            </div>
            @if ($branch->latitude && $branch->longitude)
                <div id="map" class="h-64 rounded-lg border border-gray-200 dark:border-gray-700"></div>
                @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        // Placeholder untuk implementasi peta
                        const mapElement = document.getElementById('map');
                        mapElement.innerHTML = '<div class="flex items-center justify-center h-full bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400">Peta akan ditampilkan di sini dengan koordinat: {{ $branch->latitude }}, {{ $branch->longitude }}</div>';
                    });
                </script>
                @endpush
            @else
                <div class="flex items-center justify-center h-64 bg-gray-100 dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-700 text-gray-500 dark:text-gray-400">
                    Belum ada koordinat lokasi
                </div>
            @endif
        </div>
    </div>

    <!-- Assigned Users -->
    <div class="bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 dark:bg-gray-800 p-4 sm:p-6 mt-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pengguna Cabang</h3>
            <a href="{{ route('branches.assign', $branch->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-4 h-4 mr-1 inline-block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path>
                </svg>
                Kelola Pengguna
            </a>
        </div>

        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">Pengguna</th>
                        <th scope="col" class="px-4 py-3">Email</th>
                        <th scope="col" class="px-4 py-3">Username</th>
                        <th scope="col" class="px-4 py-3">Role</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($branch->users as $user)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    @if ($user->avatar)
                                        <img class="w-8 h-8 rounded-full mr-3" src="{{ $user->avatar_url }}" alt="{{ $user->name }}">
                                    @else
                                        <div class="w-8 h-8 rounded-full mr-3 bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-gray-700 dark:text-gray-300">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">{{ $user->username }}</td>
                            <td class="px-4 py-3">
                                <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                    {{ $user->usertype }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-3 text-center">
                                Belum ada pengguna yang ditugaskan di cabang ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
