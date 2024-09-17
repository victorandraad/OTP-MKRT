<x-app-layout>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 bg-opacity-50 rounded-xl p-6 backdrop-filter backdrop-blur-lg">
                <h1 class="text-4xl font-bold text-yellow-400 mb-4">Troca: Charizard Shiny e Itens Raros</h1>
                
                <div class="mb-6">
                    <p class="text-gray-300">Olá, treinadores! Estou procurando trocar meu Charizard Shiny por outros Pokémon raros ou itens valiosos. Também tenho algumas pedras evolutivas e TMs para negociar. Confira os detalhes abaixo e entre em contato se interessar!</p>
                </div>

                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-yellow-400 mb-2">Itens no Anúncio</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-white">Charizard (Shiny)</h3>
                            <p class="text-gray-300">
                                Nível: 78<br>
                                Natureza: Adamant<br>
                                Habilidade: Blaze<br>
                                Movimentos: Flamethrower, Dragon Claw, Earthquake, Air Slash<br>
                                Pokébola: Ultra Ball
                            </p>
                        </div>
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-white">Pedra da Água</h3>
                            <p class="text-gray-300">
                                Quantidade: 2<br>
                                Usado para evoluir certos Pokémon do tipo Água
                            </p>
                        </div>
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-white">TM35 - Flamethrower</h3>
                            <p class="text-gray-300">
                                Quantidade: 1<br>
                                Ensina o movimento Flamethrower para Pokémon compatíveis
                            </p>
                        </div>
                        <div class="bg-gray-700 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-white">Master Ball</h3>
                            <p class="text-gray-300">
                                Quantidade: 1<br>
                                A Pokébola definitiva que nunca falha ao capturar um Pokémon selvagem
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h2 class="text-2xl font-semibold text-yellow-400 mb-2">Contato</h2>
                    <div class="flex space-x-4">
                        <button class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Conversar ao Vivo
                        </button>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded transition duration-300">
                            Enviar Mensagem
                        </button>
                    </div>
                </div>

                <!-- Placeholder para opção de edição (visível apenas para o dono do post) -->
                <div class="mt-8">
                    <button class="bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-2 px-4 rounded transition duration-300">
                        Editar Post
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Animação de entrada dos elementos
        gsap.from(".bg-gray-800", {opacity: 0, y: 50, duration: 0.8, ease: "power3.out"});
        gsap.from("h1, .mb-6", {opacity: 0, y: 20, duration: 0.6, stagger: 0.2, delay: 0.3, ease: "power3.out"});
        gsap.from(".grid > div", {opacity: 0, scale: 0.9, duration: 0.6, stagger: 0.1, delay: 0.6, ease: "back.out(1.7)"});
    </script>
</x-app-layout>
