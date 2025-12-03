<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Pemantauan Material</title>

    @vite('resources/css/app.css')
</head>

<body class="bg-gradient-to-br from-gray-100 to-gray-200 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white/70 backdrop-blur-xl shadow-2xl rounded-3xl p-10 border border-white/40">

        <!-- Top Icon -->
        <div class="flex justify-center mb-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-600 to-purple-400 
                        flex items-center justify-center shadow-lg">
                <!-- Icons Feather User -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 19.125a8.625 8.625 0 0115 0" />
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-2 tracking-tight">
            @yield('title')
        </h1>
        <p class="text-center text-sm text-gray-500 mb-6">
            Pemantauan Material — Inventory System
        </p>

        {{-- Content --}}
        @yield('content')

        <!-- Footer -->
        <p class="text-center text-xs text-gray-400 mt-8">
            © {{ date('Y') }} Pemantauan Material • All Rights Reserved
        </p>
    </div>

</body>
</html>
