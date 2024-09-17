<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold text-yellow-400 mb-8 text-center">Criar Novo Anúncio</h1>

            <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 backdrop-filter backdrop-blur-lg">
                <form method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300">Título do Anúncio</label>
                        <input type="text" name="title" id="title" required minlength="2" maxlength="25" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300">Descrição</label>
                        <textarea name="description" id="description" rows="3" required minlength="2" maxlength="1000" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50"></textarea>
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded transition duration-300">
                            Criar Anúncio
                        </button>
                    </div>
                </form>
            </div>

            <div class="mt-12 bg-gray-800 bg-opacity-50 rounded-xl p-6 backdrop-filter backdrop-blur-lg">
                <h2 class="text-2xl font-semibold text-yellow-400 mb-4">Adicionar Item ao Anúncio</h2>
                <form method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="item_type" class="block text-sm font-medium text-gray-300">Tipo de Item</label>
                        <select name="item_type" id="item_type" required class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                            <option value="pokemon">Pokémon</option>
                            <option value="stone">Pedra</option>
                            <option value="tm">TM</option>
                            <option value="pokeball">Pokébola</option>
                            <option value="undefined">Outro</option>
                        </select>
                    </div>

                    <div id="pokemon_fields" class="space-y-4 hidden">
                        <div>
                            <label for="pokemon_name" class="block text-sm font-medium text-gray-300">Nome do Pokémon</label>
                            <select name="pokemon_name" id="pokemon_name" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                                @php
                                    $pokemons = json_decode(file_get_contents(storage_path('app/game_data/pokemons.json')), true)['_default'];
                                @endphp
                                @foreach($pokemons as $pokemon)
                                    <option value="{{ $pokemon['name'] }}">{{ $pokemon['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="pokemon_level" class="block text-sm font-medium text-gray-300">Nível</label>
                            <input type="number" name="pokemon_level" id="pokemon_level" min="1" max="100" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="pokemon_nature" class="block text-sm font-medium text-gray-300">Natureza</label>
                            <input type="text" name="pokemon_nature" id="pokemon_nature" minlength="2" maxlength="20" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="pokemon_pokeball" class="block text-sm font-medium text-gray-300">Pokébola</label>
                            <select name="pokemon_pokeball" id="pokemon_pokeball" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                                @php
                                    $pokeballs = json_decode(file_get_contents(storage_path('app/game_data/pokeballs.json')), true)['_default'];
                                @endphp
                                @foreach($pokeballs as $pokeball)
                                    <option value="{{ $pokeball['name'] }}">{{ $pokeball['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="pokemon_addon" class="block text-sm font-medium text-gray-300">Addon</label>
                            <input type="text" name="pokemon_addon" id="pokemon_addon" maxlength="100" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="pokemon_boost" class="block text-sm font-medium text-gray-300">Boost</label>
                            <input type="number" name="pokemon_boost" id="pokemon_boost" min="0" max="10" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                        </div>
                    </div>

                    <div id="item_fields" class="space-y-4 hidden">
                        <div>
                            <label for="item_name" class="block text-sm font-medium text-gray-300">Nome do Item</label>
                            <select name="item_name" id="item_name" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                                <!-- Options will be populated dynamically based on item type -->
                            </select>
                        </div>
                        <div>
                            <label for="item_quantity" class="block text-sm font-medium text-gray-300">Quantidade</label>
                            <input type="number" name="item_quantity" id="item_quantity" min="1" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50">
                        </div>
                    </div>

                    <div>
                        <label for="item_price" class="block text-sm font-medium text-gray-300">Preço</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input type="number" name="item_price" id="item_price" min="0" step="0.01" required class="pl-7 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50" placeholder="0.00">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded transition duration-300">
                            Adicionar Item ao Anúncio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const itemTypeSelect = document.getElementById('item_type');
        const pokemonFields = document.getElementById('pokemon_fields');
        const itemFields = document.getElementById('item_fields');
        const itemNameSelect = document.getElementById('item_name');

        const itemData = {
            stone: @json(json_decode(file_get_contents(storage_path('app/game_data/stones.json')), true)['_default']),
            tm: @json(json_decode(file_get_contents(storage_path('app/game_data/tms.json')), true)['_default']),
            pokeball: @json(json_decode(file_get_contents(storage_path('app/game_data/pokeballs.json')), true)['_default'])
        };

        function updateFields() {
            const selectedType = itemTypeSelect.value;
            if (selectedType === 'pokemon') {
                pokemonFields.classList.remove('hidden');
                itemFields.classList.add('hidden');
            } else {
                pokemonFields.classList.add('hidden');
                itemFields.classList.remove('hidden');
                
                // Populate item names based on selected type
                itemNameSelect.innerHTML = '';
                if (selectedType in itemData) {
                    Object.values(itemData[selectedType]).forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.name;
                        option.textContent = item.name;
                        itemNameSelect.appendChild(option);
                    });
                } else {
                    // For 'undefined' type, provide a text input instead
                    const textInput = document.createElement('input');
                    textInput.type = 'text';
                    textInput.name = 'item_name';
                    textInput.id = 'item_name';
                    textInput.className = itemNameSelect.className;
                    textInput.required = true;
                    textInput.minLength = 2;
                    textInput.maxLength = 50;
                    itemNameSelect.parentNode.replaceChild(textInput, itemNameSelect);
                }
            }
        }

        // Update fields when the page loads
        updateFields();

        // Update fields when the item type changes
        itemTypeSelect.addEventListener('change', updateFields);

        gsap.from("form > *", {opacity: 0, y: 20, duration: 0.6, stagger: 0.1, ease: "power3.out"});
    </script>
</x-app-layout>