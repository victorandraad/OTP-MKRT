<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PokéTrade Hub</title>
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
        .card {
            transition: all 0.3s ease;
        }
        .card-container:hover .card:not(:hover) {
            filter: blur(2px);
            opacity: 0.7;
            transform: scale(0.98);
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
                    <h1 class="text-3xl font-bold text-yellow-400">PokéTrade Hub</h1>
                    <div class="space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-300 hover:text-yellow-400 transition duration-300">Painel</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-300 hover:text-yellow-400 transition duration-300">Entrar</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-gray-300 hover:text-yellow-400 transition duration-300">Registrar</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </nav>
            </header>

            <main class="flex-grow flex items-center justify-center px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl w-full space-y-16">
                    <div class="text-center">
                        <h2 class="text-5xl sm:text-6xl font-bold mb-6 leading-tight">Bem-vindo à Melhor<br>Experiência de Troca Pokémon</h2>
                        <p class="text-xl sm:text-2xl text-gray-300 mb-12">Conecte-se, troque e converse com treinadores de todo o mundo</p>
                        <a href="{{ route('dashboard') }}" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold text-xl py-4 px-8 rounded-full transition duration-300 transform hover:scale-105 hover:shadow-lg animate-float">
                            Entrar na Central
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 card-container">
                        <div class="bg-gray-800 bg-opacity-50 p-8 rounded-xl backdrop-filter backdrop-blur-lg hover:bg-opacity-70 transition duration-300 card">
                            <h3 class="text-2xl font-semibold mb-4">Trocas em Tempo Real</h3>
                            <p class="text-gray-300 mb-4">Experimente trocas de Pokémon em tempo real com treinadores globalmente. Nossa plataforma avançada garante trocas seguras e sem complicações.</p>
                        </div>
                        <div class="bg-gray-800 bg-opacity-50 p-8 rounded-xl backdrop-filter backdrop-blur-lg hover:bg-opacity-70 transition duration-300 card">
                            <h3 class="text-2xl font-semibold mb-4">Insights de Mercado</h3>
                            <p class="text-gray-300 mb-4">Fique à frente com tendências e preços atualizados do mercado. Tome decisões informadas e maximize seu potencial de troca.</p>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-6 px-4 sm:px-6 lg:px-8 text-center">
                <p>&copy; 2023 Central de Trocas Pokémon. Todos os direitos reservados.</p>
            </footer>
        </div>
    </div>

    <script>
        gsap.from("header", {opacity: 0, y: -50, duration: 1, ease: "power3.out"});
        gsap.from("main > div > *", {opacity: 0, y: 50, duration: 1, stagger: 0.2, ease: "power3.out"});
        gsap.from(".grid > div", {opacity: 0, scale: 0.8, duration: 0.8, stagger: 0.2, ease: "back.out(1.7)"});
    </script>
</body>
</html>