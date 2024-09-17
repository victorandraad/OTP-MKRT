<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PokéTrade Hub') }} - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .animate-float {
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 min-h-screen">
    <div class="relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-purple-900 opacity-50"></div>
            <img src="https://wallpaperaccess.com/full/45664.jpg" alt="Fundo Pokémon" class="w-full h-full object-cover object-center">
        </div>
        
        <div class="relative z-10 min-h-screen flex flex-col">
            <header class="py-6 px-4 sm:px-6 lg:px-8">
                <nav class="flex justify-between items-center">
                    <a href="{{ url('/') }}" class="text-3xl font-bold text-yellow-400">PokéTrade Hub</a>
                </nav>
            </header>

            <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
                <div class="max-w-md w-full space-y-8 bg-gray-800 bg-opacity-50 p-8 rounded-xl backdrop-filter backdrop-blur-lg">
                    @yield('content')
                </div>
            </main>

            <footer class="py-6 px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; {{ date('Y') }} PokéTrade Hub. Todos os direitos reservados.</p>
            </footer>
        </div>
    </div>

    <script>
        gsap.from("main > div", {opacity: 0, y: 50, duration: 1, ease: "power3.out"});
    </script>
</body>
</html>