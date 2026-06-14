@extends('layouts.app')

@section('title', 'Pengaturan Profil - Sistem Sembako')
@section('header', 'Pengaturan Profil')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
        <div class="flex items-center mb-8 pb-4 border-b border-gray-100">
            <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl mr-4 overflow-hidden border border-blue-200">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=E0F2FE&color=0284C7&bold=true&size=48" alt="Avatar" class="w-full h-full object-cover">
            </div>
            <div>
                <h3 class="text-lg font-bold text-gray-800">Edit Profil Anda</h3>
                <p class="text-xs text-gray-500">Perbarui informasi login Anda</p>
            </div>
        </div>

        <form action="{{ route('pengaturan.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Username <span class="text-red-500">*</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 text-sm transition-all" required>
                </div>
                @error('username')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-8">
                <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru <span class="text-xs text-gray-400 font-normal ml-1">(Kosongkan jika tidak ingin diubah)</span></label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <input type="password" id="password" name="password" class="block w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 text-sm transition-all" placeholder="Minimal 6 karakter">
                </div>
                @error('password')
                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end border-t border-gray-100 pt-6">
                <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
