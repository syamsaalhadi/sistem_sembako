@extends('layouts.app')

@section('title', 'Manajemen Pengguna - Sistem Sembako')
@section('header', 'Manajemen Pengguna')

@section('content')

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form Tambah/Edit -->
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative">
            <div class="flex items-center mb-6">
                <div class="w-1 h-5 bg-blue-600 rounded-full mr-3"></div>
                <h3 class="text-sm font-bold text-gray-800">
                    {{ isset($_GET['edit']) ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}
                </h3>
            </div>

            @php
                $editAdmin = null;
                if(isset($_GET['edit'])) {
                    $editAdmin = \App\Models\Admin::find($_GET['edit']);
                }
            @endphp

            <form action="{{ $editAdmin ? route('pengguna.update', $editAdmin->id_admin) : route('pengguna.store') }}" method="POST">
                @csrf
                @if($editAdmin)
                    @method('PUT')
                @endif
                
                <div class="mb-4">
                    <label for="username" class="block text-xs font-semibold text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
                    <input type="text" id="username" name="username" value="{{ old('username', $editAdmin ? $editAdmin->username : '') }}" class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 text-sm" required>
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-xs font-semibold text-gray-700 mb-2">
                        Password {!! $editAdmin ? '(Kosongkan jika tidak diubah)' : '<span class="text-red-500">*</span>' !!}
                    </label>
                    <input type="password" id="password" name="password" class="block w-full px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 text-sm" {{ $editAdmin ? '' : 'required' }}>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                        {{ $editAdmin ? 'Update' : 'Simpan' }}
                    </button>
                    @if($editAdmin)
                        <a href="{{ route('pengguna.index') }}" class="flex-1 text-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold rounded-lg transition-colors shadow-sm">
                            Batal
                        </a>
                    @else
                        <button type="reset" class="flex-1 px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm font-semibold rounded-lg transition-colors shadow-sm">
                            Reset
                        </button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Daftar Pengguna -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="text-base font-bold text-gray-800">Daftar Admin</h3>
            </div>
            <div class="p-0 overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="bg-gray-50/50 text-gray-500 font-medium border-b border-gray-100 text-xs uppercase tracking-wider">
                            <th class="py-4 px-6">No</th>
                            <th class="py-4 px-6">Username</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($admins as $index => $admin)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-6 text-gray-500">{{ $index + 1 }}</td>
                            <td class="py-3 px-6 text-gray-800 font-medium">{{ $admin->username }}
                                @if($admin->id_admin == Auth::id())
                                    <span class="ml-2 px-2 py-0.5 text-[10px] bg-green-100 text-green-700 rounded-full font-bold">You</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('pengguna.index', ['edit' => $admin->id_admin]) }}" class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 hover:bg-blue-200 text-blue-600 rounded transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </a>
                                    @if($admin->id_admin != Auth::id())
                                    <form action="{{ route('pengguna.destroy', $admin->id_admin) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus admin ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 rounded transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
