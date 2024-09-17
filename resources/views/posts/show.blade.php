<x-app-layout>
    <div class="py-12 bg-main min-h-screen">
        <div class="container-xl">
            <div class="bg-card">
                <h1 class="text-title">{{ $post->title }}</h1>
                
                <div class="mb-6">
                    <p class="text-body">{{ $post->description }}</p>
                </div>

                <div class="mb-6">
                    <h2 class="text-subtitle">Detalhes do Item</h2>
                    <div class="grid-responsive">
                        @if ($post->pokemon->isNotEmpty())
                            @foreach ($post->pokemon as $pokemon)
                                <div class="card">
                                    <h3 class="text-lg font-semibold text-white">{{ $pokemon->name }}</h3>
                                    <p class="text-body">
                                        Nível: {{ $pokemon->level }}<br>
                                        Natureza: {{ $pokemon->nature }}<br>
                                        Pokébola: {{ $pokemon->pokeball }}<br>
                                        Addon: {{ $pokemon->addon }}<br>
                                        Boost: {{ $pokemon->boost }}<br>
                                        Preço: R${{ $pokemon->price }}
                                    </p>
                                </div>
                            @endforeach
                        @elseif ($post->items->isNotEmpty())
                            @foreach ($post->items as $item)
                                <div class="card">
                                    <h3 class="text-lg font-semibold text-white">{{ $item->name }}</h3>
                                    <p class="text-body">
                                        Tipo: {{ $item->type }}<br>
                                        Quantidade: {{ $item->quantity }}<br>
                                        Preço: R${{ $item->price }}
                                    </p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-subtitle">Contato</h2>
                    <div class="flex space-x-4">
                        <button class="btn btn-primary">
                            Chat ao Vivo
                        </button>
                        <button class="btn btn-secondary">
                            Enviar Mensagem
                        </button>
                    </div>
                </div>

                @if (Auth::id() === $post->user_id)
                    <div class="mt-8">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">
                            Editar Anúncio
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
