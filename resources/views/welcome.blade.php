<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Perpustakaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* CSS untuk scrollbar transparan */
        .custom-scroll::-webkit-scrollbar {
            display: none;
        }

        .custom-scroll {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-gray-900 text-white">
    <!-- Navbar -->
    <header class="bg-gray-800 text-white py-4">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <div class="flex items-center">
                <div class="text-3xl font-bold text-blue-500">P</div>
                <span class="text-lg font-semibold">erpustakaan</span>
            </div>
            <!-- Navigation -->
            <nav class="flex space-x-6">
                <div>
                    @if (Route::has('login'))
                        <div>
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="font-semibold text-gray-300 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="font-semibold text-gray-300 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-4 font-semibold text-gray-300 hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-blue-500">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </nav>
        </div>
    </header>

    <!-- Kontainer Scroll -->
    <div class="overflow-auto custom-scroll max-h-[600px] rounded-lg">
        <!-- Hero Section -->
        <section class="relative bg-cover bg-center h-screen"
            style="background-image: url('https://source.unsplash.com/1600x900/?library');">
            <div class="absolute inset-0 bg-black bg-opacity-60"></div>
            <div class="container mx-auto relative z-10 text-center flex flex-col items-center justify-center h-full px-6">
                <h1 class="text-5xl md:text-6xl font-bold mb-4">Selamat Datang Pada Aplikasi Perpustakaan Daerah</h1>
                <p class="text-lg md:text-xl text-gray-300 mb-6">Hubungi Customer Service Jika Ada Kesulitan</p>
            </div>
        </section>
    </div>
</body>

</html>
