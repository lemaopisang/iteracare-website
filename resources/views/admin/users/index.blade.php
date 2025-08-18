@extends("admin.layouts.app")

@section("title", "Manajemen Pengguna")

@section("content")
<div class="space-y-6">
    <!-- Page Header -->
    <div class="md:flex md:items-center md:justify-between">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                Manajemen Pengguna
            </h2>
            <p class="mt-1 text-sm text-gray-500">
                Kelola semua pengguna, sales representative, dan administrator.
            </p>
        </div>
        <div class="mt-4 flex md:mt-0 md:ml-4">
            <a href="{{ route("admin.users.create") }}"
               class="ml-3 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Tambah Pengguna Baru
            </a>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <ul class="divide-y divide-gray-200">
            @forelse($users as $user)
                <li>
                    <div class="px-4 py-4 flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-sm font-medium text-gray-700">{{ substr($user->name, 0, 2) }}</span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="flex items-center">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $user->role === "admin" ? "bg-red-100 text-red-800" : "bg-green-100 text-green-800" }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                    @if(!$user->is_active)
                                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            Tidak Aktif
                                        </span>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                @if($user->phone)
                                    <div class="text-sm text-gray-500">{{ $user->phone }}</div>
                                @endif
                                @if($user->referral_code)
                                    <div class="text-xs text-blue-600 font-mono">Referral: {{ $user->referral_code }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                Edit
                            </a>
                            <a href="{{ route('admin.users.duplicate', $user) }}"
                               class="text-yellow-600 hover:text-yellow-900 text-sm font-medium">
                                Duplikat
                            </a>
                            <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 text-sm font-medium">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @empty
                <li>
                    <div class="px-4 py-8 text-center">
                        <div class="text-sm text-gray-500">Tidak ada pengguna ditemukan.</div>
                        <div class="mt-2">
                            <a href="{{ route("admin.users.create") }}"
                               class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                Buat pengguna pertama Anda
                            </a>
                        </div>
                    </div>
                </li>
            @endforelse
        </ul>
    </div>

    <!-- Pagination -->
    @if($users->hasPages())
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            {{ $users->links() }}
        </div>
    @endif
</div>
@endsection


