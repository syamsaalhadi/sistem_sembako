<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Sembako</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f0f4f8;
            background-image: radial-gradient(circle at 10% 20%, rgba(216, 234, 255, 1) 0%, rgba(240, 244, 248, 1) 90%);
        }
        .bg-pattern {
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen p-3 sm:p-4">

    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-xl md:rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
        
        <!-- Left Side (Blue Branding) -->
        <div class="md:w-5/12 bg-blue-600 bg-pattern flex flex-col items-center justify-center p-6 sm:p-8 md:p-10 text-white text-center relative overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -bottom-16 -left-16 w-48 h-48 bg-blue-500 rounded-full mix-blend-multiply filter blur-2xl opacity-50"></div>
            <div class="absolute -top-16 -right-16 w-48 h-48 bg-blue-400 rounded-full mix-blend-multiply filter blur-2xl opacity-50"></div>

            <div class="relative z-10">
                <div class="inline-flex items-center justify-center w-14 h-14 sm:w-16 sm:h-16 md:w-20 md:h-20 rounded-full border-[3px] border-white mb-4 md:mb-6">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 md:w-10 md:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                </div>
                
                <h1 class="text-base sm:text-lg md:text-xl font-bold tracking-wide mb-1 md:mb-2 uppercase">Sistem Prediksi & <br> Rekomendasi Stok</h1>
                <p class="text-blue-100 mb-3 md:mb-6 text-xs md:text-sm">Menggunakan Logika Fuzzy</p>
                
                <div class="w-10 md:w-12 h-0.5 bg-blue-300 mx-auto mb-3 md:mb-6"></div>
                
                <p class="text-xs md:text-sm text-blue-100 leading-relaxed max-w-xs mx-auto hidden sm:block">
                    Sistem ini membantu memprediksi permintaan dan memberikan rekomendasi jumlah stok barang yang optimal.
                </p>
            </div>
        </div>

        <!-- Right Side (Login Form) -->
        <div class="md:w-7/12 p-6 sm:p-8 md:p-10 lg:p-16 flex flex-col justify-center bg-white relative">
            <div class="text-center mb-6 md:mb-8">
                <div class="inline-flex items-center justify-center w-14 h-14 md:w-20 md:h-20 rounded-full bg-blue-50 text-blue-500 mb-3 md:mb-4">
                    <svg class="w-7 h-7 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Login</h2>
                <p class="text-xs md:text-sm text-gray-500 mt-1 md:mt-2">Masukkan kredensial Anda untuk melanjutkan</p>
            </div>

            @if($errors->any())
                <div class="mb-4 md:mb-6 bg-red-50 border border-red-100 text-red-600 p-3 md:p-4 rounded-lg md:rounded-xl text-xs md:text-sm" role="alert">
                    <ul class="list-disc pl-4 md:pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4 md:space-y-5">
                @csrf
                
                <div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 md:pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" class="block w-full pl-10 md:pl-11 pr-4 py-3 md:py-3.5 border border-gray-200 rounded-lg md:rounded-xl text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm" placeholder="Username" required autofocus>
                    </div>
                </div>

                <div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 md:pl-4 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 md:h-5 md:w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" id="password" name="password" class="block w-full pl-10 md:pl-11 pr-10 md:pr-11 py-3 md:py-3.5 border border-gray-200 rounded-lg md:rounded-xl text-gray-700 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-sm" placeholder="Kata Sandi" required>
                    </div>
                </div>

                <div class="pt-2 md:pt-4">
                    <button type="submit" class="w-full flex justify-center py-3 md:py-3.5 px-4 border border-transparent rounded-lg md:rounded-xl shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        Login
                    </button>
                </div>
            </form>
            
            <div class="mt-6 md:mt-10 text-center">
                <p class="text-[10px] md:text-xs text-gray-400">&copy; {{ date('Y') }} Sistem Prediksi & Rekomendasi Stok</p>
            </div>
        </div>

    </div>

</body>
</html>
