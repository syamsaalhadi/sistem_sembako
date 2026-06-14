<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

    </style>
</head>

<body class="text-gray-800 min-h-screen text-sm bg-gray-50">

    <div class="flex min-h-screen">

        <!-- Overlay (mobile only) -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden" onclick="toggleSidebar()">
        </div>

        <!-- Sidebar -->
        <aside id="sidebar"
            class="w-64 bg-[#1e40af] text-white flex flex-col fixed inset-y-0 left-0 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out md:relative shadow-xl md:shadow-none">
            <div class="h-16 md:h-20 flex items-center px-6 border-b border-blue-800/50">
                <div class="flex items-center">
                    <div
                        class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-white text-[#1e40af] flex items-center justify-center font-bold text-lg md:text-xl shadow-inner mr-3 flex-shrink-0">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <h1 class="font-bold text-[11px] md:text-xs tracking-wide uppercase leading-tight">Sistem
                            Prediksi & Rekomendasi Stok</h1>
                        <span class="text-[10px] text-blue-200 block mt-0.5">Logika Fuzzy</span>
                    </div>
                </div>
            </div>

            <!-- Hamburger toggle inside sidebar (mobile only) -->
            <button onclick="toggleSidebar()"
                class="md:hidden absolute top-4 right-4 text-white hover:bg-white/10 p-2 rounded-lg transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <div class="flex-1 overflow-y-auto py-6 px-4 space-y-1.5 md:space-y-2 text-sm md:text-sm">
                <!-- Navigation Links -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all {{ request()->routeIs('dashboard') ? 'bg-[#2563eb] text-white font-semibold shadow-md' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="truncate">Dashboard</span>
                </a>

                <a href="{{ route('barang.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all {{ request()->routeIs('barang.*') ? 'bg-[#2563eb] text-white font-semibold shadow-md' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span class="truncate">Data Barang</span>
                </a>

                <a href="{{ route('penjualan.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all {{ request()->routeIs('penjualan.*') ? 'bg-[#2563eb] text-white font-semibold shadow-md' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <span class="truncate">Data Penjualan</span>
                </a>

                <!-- <a href="#"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <span class="truncate">Data Stok</span>
                </a> -->

                <a href="{{ route('prediksi.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all {{ request()->routeIs('prediksi.*') ? 'bg-[#2563eb] text-white font-semibold shadow-md' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                    </svg>
                    <span class="truncate">Prediksi & Rekomendasi</span>
                </a>

                <a href="{{ route('fuzzy.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all {{ request()->routeIs('fuzzy.*') ? 'bg-[#2563eb] text-white font-semibold shadow-md' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                    </svg>
                    <span class="truncate">Aturan Fuzzy</span>
                </a>

                <a href="{{ route('laporan.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all {{ request()->routeIs('laporan.*') ? 'bg-[#2563eb] text-white font-semibold shadow-md' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span class="truncate">Laporan</span>
                </a>

                <a href="{{ route('pengguna.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all {{ request()->routeIs('pengguna.*') ? 'bg-[#2563eb] text-white font-semibold shadow-md' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    <span class="truncate">Pengguna</span>
                </a>

                <a href="{{ route('pengaturan.index') }}"
                    class="flex items-center px-4 py-3 rounded-xl text-blue-100 hover:bg-white/10 hover:text-white transition-all {{ request()->routeIs('pengaturan.*') ? 'bg-[#2563eb] text-white font-semibold shadow-md' : '' }}">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="truncate">Pengaturan</span>
                </a>
            </div>

            <div class="p-4 border-t border-blue-800/50 mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center px-4 py-3 text-sm text-blue-100 hover:bg-white/10 hover:text-white rounded-xl transition-all">
                        <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        <span class="truncate">Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen min-w-0 bg-[#f8fafc]">
            <!-- Topbar -->
            <header
                class="h-16 md:h-20 bg-white border-b border-gray-100 flex items-center justify-between px-6 flex-shrink-0 z-10 shadow-sm sticky top-0">
                <div class="flex items-center min-w-0">
                    <!-- Hamburger for mobile -->
                    <button onclick="toggleSidebar()"
                        class="text-gray-500 hover:text-gray-700 mr-3 md:hidden flex-shrink-0 p-1">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                    <h2 class="text-base md:text-lg font-bold text-gray-800 truncate">@yield('header')</h2>
                </div>

                <div class="flex items-center space-x-2 md:space-x-3 flex-shrink-0">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-800 leading-none">
                            {{ Auth::user()->username ?? 'Admin' }}
                        </p>
                        <p class="text-[11px] text-gray-500 mt-1">Administrator</p>
                    </div>
                    <div
                        class="w-8 h-8 md:w-10 md:h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold overflow-hidden border border-blue-200 flex-shrink-0">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->username ?? 'A' }}&background=E0F2FE&color=0284C7&bold=true&size=40"
                            alt="Avatar" class="w-full h-full object-cover">
                    </div>
                </div>
            </header>

            <!-- Main Scrollable Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-3 sm:p-4 md:p-6 lg:p-8">

                @if(session('success'))
                    <div class="mb-4 md:mb-6 bg-green-50 border border-green-200 text-green-700 px-3 md:px-4 py-3 rounded-lg relative flex items-center shadow-sm"
                        role="alert">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span class="text-sm">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 md:mb-6 bg-red-50 border border-red-200 text-red-700 px-3 md:px-4 py-3 rounded-lg relative flex items-center shadow-sm"
                        role="alert">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                        <span class="text-sm">{{ session('error') }}</span>
                    </div>
                @endif

                @yield('content')

                <footer class="mt-6 md:mt-8 pt-4 border-t border-gray-200 text-xs text-gray-400">
                    &copy; {{ date('Y') }} Sistem Prediksi & Rekomendasi Stok. All rights reserved.
                </footer>
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        function closeSidebarOnMobile() {
            if (window.innerWidth < 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        }

        // Close sidebar on resize to desktop
        window.addEventListener('resize', function () {
            if (window.innerWidth >= 768) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('sidebar-overlay');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }
        });
    </script>

    @stack('scripts')
</body>

</html>