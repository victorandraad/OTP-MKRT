<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 backdrop-filter backdrop-blur-lg">
                <h1 class="text-4xl font-bold text-yellow-400 mb-8">Edit Post</h1>
                <form action="{{ route('posts.update', $post->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-300">Title</label>
                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50" id="title" name="title" value="{{ $post->title }}" required minlength="2" maxlength="25">
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-300">Description</label>
                        <textarea class="mt-1 block w-full rounded-md bg-gray-700 border-gray-600 text-white focus:border-yellow-400 focus:ring focus:ring-yellow-400 focus:ring-opacity-50" id="description" name="description" rows="5" required minlength="2" maxlength="1000">{{ $post->description }}</textarea>
                    </div>

                    @if ($post->pokemon->isNotEmpty())
                        @foreach ($post->pokemon as $index => $pokemon)
                            <div class="bg-gray-700 p-4 rounded-lg mt-4">
                                <h3 class="text-lg font-semibold text-white mb-2">Pokémon {{ $index + 1 }}</h3>
                                <input type="hidden" name="pokemon[{{ $index }}][id]" value="{{ $pokemon->id }}">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="pokemon_name_{{ $index }}" class="block text-sm font-medium text-gray-300">Name</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="pokemon_name_{{ $index }}" name="pokemon[{{ $index }}][name]" value="{{ $pokemon->name }}" required>
                                    </div>
                                    <div>
                                        <label for="pokemon_level_{{ $index }}" class="block text-sm font-medium text-gray-300">Level</label>
                                        <input type="number" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="pokemon_level_{{ $index }}" name="pokemon[{{ $index }}][level]" value="{{ $pokemon->level }}" required>
                                    </div>
                                    <div>
                                        <label for="pokemon_nature_{{ $index }}" class="block text-sm font-medium text-gray-300">Nature</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="pokemon_nature_{{ $index }}" name="pokemon[{{ $index }}][nature]" value="{{ $pokemon->nature }}" required>
                                    </div>
                                    <div>
                                        <label for="pokemon_pokeball_{{ $index }}" class="block text-sm font-medium text-gray-300">Pokeball</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="pokemon_pokeball_{{ $index }}" name="pokemon[{{ $index }}][pokeball]" value="{{ $pokemon->pokeball }}" required>
                                    </div>
                                    <div>
                                        <label for="pokemon_addon_{{ $index }}" class="block text-sm font-medium text-gray-300">Addon</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="pokemon_addon_{{ $index }}" name="pokemon[{{ $index }}][addon]" value="{{ $pokemon->addon }}">
                                    </div>
                                    <div>
                                        <label for="pokemon_boost_{{ $index }}" class="block text-sm font-medium text-gray-300">Boost</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="pokemon_boost_{{ $index }}" name="pokemon[{{ $index }}][boost]" value="{{ $pokemon->boost }}">
                                    </div>
                                    <div>
                                        <label for="pokemon_price_{{ $index }}" class="block text-sm font-medium text-gray-300">Price</label>
                                        <input type="number" step="0.01" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="pokemon_price_{{ $index }}" name="pokemon[{{ $index }}][price]" value="{{ $pokemon->price }}" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @elseif ($post->items->isNotEmpty())
                        @foreach ($post->items as $index => $item)
                            <div class="bg-gray-700 p-4 rounded-lg mt-4">
                                <h3 class="text-lg font-semibold text-white mb-2">Item {{ $index + 1 }}</h3>
                                <input type="hidden" name="items[{{ $index }}][id]" value="{{ $item->id }}">
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="item_type_{{ $index }}" class="block text-sm font-medium text-gray-300">Type</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="item_type_{{ $index }}" name="items[{{ $index }}][type]" value="{{ $item->type }}" required>
                                    </div>
                                    <div>
                                        <label for="item_name_{{ $index }}" class="block text-sm font-medium text-gray-300">Name</label>
                                        <input type="text" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="item_name_{{ $index }}" name="items[{{ $index }}][name]" value="{{ $item->name }}" required>
                                    </div>
                                    <div>
                                        <label for="item_quantity_{{ $index }}" class="block text-sm font-medium text-gray-300">Quantity</label>
                                        <input type="number" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="item_quantity_{{ $index }}" name="items[{{ $index }}][quantity]" value="{{ $item->quantity }}" required>
                                    </div>
                                    <div>
                                        <label for="item_price_{{ $index }}" class="block text-sm font-medium text-gray-300">Price</label>
                                        <input type="number" step="0.01" class="mt-1 block w-full rounded-md bg-gray-600 border-gray-500 text-white" id="item_price_{{ $index }}" name="items[{{ $index }}][price]" value="{{ $item->price }}" required>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                    <div class="flex justify-between items-center">
                        <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded transition duration-300">Update Post</button>
                        
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded transition duration-300">Delete Post</button>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
