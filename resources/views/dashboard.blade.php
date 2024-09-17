<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-yellow-400 mb-8 text-center">Marketplace Pokémon</h1>

            @auth
                <div class="mb-8 text-center">
                    <a href="#" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded transition duration-300">
                        Criar Novo Anúncio
                    </a>
                </div>
            @else
                <div class="mb-8 text-center">
                    <p class="text-gray-300 mb-2">Para criar anúncios, você precisa ter uma conta.</p>
                    <a href="{{ route('login') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300 mr-2">
                        Entrar
                    </a>
                    <a href="{{ route('register') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                        Registrar
                    </a>
                </div>
            @endauth

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $categories = [
                        'Pokémons' => 'pokemons.json',
                        'Pokébolas' => 'pokeballs.json',
                        'TMs' => 'tms.json',
                        'Pedras' => 'stones.json'
                    ];
                @endphp

                @foreach ($categories as $categoryName => $fileName)
                    <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 backdrop-filter backdrop-blur-lg hover:bg-opacity-70 transition duration-300">
                        <h2 class="text-2xl font-semibold text-yellow-400 mb-4">{{ $categoryName }}</h2>
                        <ul class="space-y-2">
                            @php
                                $items = json_decode(file_get_contents(storage_path("app/game_data/$fileName")), true)['_default'];
                                $displayItems = array_slice($items, 0, 5);
                            @endphp

                            @foreach ($displayItems as $item)
                                <li class="flex items-center space-x-2">
                                    <img src="{{ $item['link'] }}" alt="{{ $item['name'] }}" class="w-8 h-8 object-contain">
                                    <span class="text-gray-300">{{ $item['name'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#" class="mt-4 inline-block text-yellow-400 hover:text-yellow-300 transition duration-300">
                            Ver todos os {{ $categoryName }} →
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="mt-12 bg-gray-800 bg-opacity-50 rounded-xl p-6 backdrop-filter backdrop-blur-lg">
                <h2 class="text-2xl font-semibold text-yellow-400 mb-4">Anúncios Recentes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @for ($i = 1; $i <= 6; $i++)
                        <div class="bg-gray-700 bg-opacity-50 rounded-lg p-4 hover:bg-opacity-70 transition duration-300">
                            <h3 class="text-xl font-semibold text-white mb-2">Anúncio de Exemplo {{ $i }}</h3>
                            <p class="text-gray-300 mb-4">Este é um anúncio de exemplo para demonstrar o layout do marketplace.</p>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400 text-sm">Usuário {{ $i }}</span>
                                <a href="#" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded transition duration-300">
                                    Ver Detalhes
                                </a>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>

    <script>
        gsap.from(".grid > div", {opacity: 0, y: 50, duration: 0.8, stagger: 0.2, ease: "power3.out"});
    </script>
</x-app-layout>
