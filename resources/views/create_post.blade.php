<x-app-layout>
    <div class="py-12 bg-main min-h-screen">
        <div class="container-xl">
            <h1 class="text-title text-center">Criar Novo Anúncio</h1>

            <div class="bg-card hover:bg-opacity-70 transition duration-300">
                <form id="createPostForm" class="space-y-6">
                    @csrf
                    <div>
                        <label for="title" class="form-label">Título</label>
                        <input type="text" id="title" name="title" class="form-input" required>
                    </div>

                    <div>
                        <label for="description" class="form-label">Descrição</label>
                        <textarea id="description" name="description" rows="4" class="form-input" required></textarea>
                    </div>

                    <div id="itemsContainer" class="space-y-4">
                        <!-- Items will be added here dynamically -->
                    </div>

                    <div class="flex justify-between">
                        <button type="button" id="addPokemon" class="btn btn-secondary">Adicionar Pokémon</button>
                        <button type="button" id="addItem" class="btn btn-secondary">Adicionar Item</button>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Criar Anúncio</button>
                    </div>

                    <!-- Hidden input for items JSON -->
                    <input type="hidden" id="itemsJson" name="items" value="">
                </form>
            </div>
        </div>
    </div>

    <script>
        const pokemons = @json($pokemons);
        const tms = @json($tms);
        const stones = @json($stones);
        const pokeballs = @json($pokeballs);

        document.addEventListener('DOMContentLoaded', function() {
            let itemCount = 0;
            const items = [];

            function addItemToForm(type) {
                const itemId = itemCount++;
                const item = { type, id: itemId };
                items.push(item);

                const container = document.createElement('div');
                container.className = 'bg-gray-700 p-4 rounded-lg relative';
                container.id = `item-${itemId}`;
                container.innerHTML = `
                    <button type="button" class="remove-item btn btn-danger absolute top-2 right-2" data-item-id="${itemId}">
                        Remover
                    </button>
                    <h3 class="text-subtitle mb-2">${type === 'pokemon' ? 'Pokémon' : 'Item'}</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="form-label">Nome</label>
                            ${type === 'pokemon' 
                                ? `<select class="form-select item-input" data-field="name" required>${pokemons.map(p => `<option value="${p}">${p}</option>`).join('')}</select>`
                                : `
                                    <select class="form-select item-input" data-field="type" required>
                                        <option value="">Selecione o tipo de item</option>
                                        <option value="tm">TM</option>
                                        <option value="stone">Stone</option>
                                        <option value="pokeball">Pokeball</option>
                                        <option value="undefined">Outro</option>
                                    </select>
                                    <div id="itemNameContainer${itemId}" class="mt-2"></div>
                                `
                            }
                        </div>
                        <div>
                            <label class="form-label">Preço</label>
                            <input type="number" class="form-input item-input" data-field="price" required>
                        </div>
                        ${type === 'pokemon' ? `
                            <div>
                                <label class="form-label">Nível</label>
                                <input type="number" class="form-input item-input" data-field="level" required>
                            </div>
                            <div>
                                <label class="form-label">Natureza</label>
                                <input type="text" class="form-input item-input" data-field="nature" required>
                            </div>
                            <div>
                                <label class="form-label">Pokébola</label>
                                <select class="form-select item-input" data-field="pokeball" required>
                                    ${pokeballs.map(p => `<option value="${p}">${p}</option>`).join('')}
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Addon</label>
                                <input type="text" class="form-input item-input" data-field="addon" required>
                            </div>
                            <div>
                                <label class="form-label">Boost</label>
                                <input type="text" class="form-input item-input" data-field="boost" required>
                            </div>
                        ` : `
                            <div>
                                <label class="form-label">Quantidade</label>
                                <input type="number" class="form-input item-input" data-field="quantity" required>
                            </div>
                        `}
                    </div>
                `;
                document.getElementById('itemsContainer').appendChild(container);

                // Adiciona o evento de remoção ao botão
                container.querySelector('.remove-item').addEventListener('click', function() {
                    removeItem(itemId);
                });

                // Adiciona eventos para atualizar o item quando os inputs mudam
                container.querySelectorAll('.item-input').forEach(input => {
                    input.addEventListener('change', () => updateItem(itemId));
                });

                if (type !== 'pokemon') {
                    const itemTypeSelect = container.querySelector(`select[data-field="type"]`);
                    const itemNameContainer = container.querySelector(`#itemNameContainer${itemId}`);

                    itemTypeSelect.addEventListener('change', function() {
                        const selectedType = this.value;
                        let options = [];

                        switch (selectedType) {
                            case 'tm':
                                options = tms;
                                break;
                            case 'stone':
                                options = stones;
                                break;
                            case 'pokeball':
                                options = pokeballs;
                                break;
                            case 'undefined':
                                itemNameContainer.innerHTML = `<input type="text" class="form-input item-input" data-field="name" required placeholder="Digite o nome do item">`;
                                return;
                            default:
                                itemNameContainer.innerHTML = '';
                                return;
                        }

                        const select = document.createElement('select');
                        select.className = 'form-select item-input';
                        select.setAttribute('data-field', 'name');
                        select.required = true;
                        select.innerHTML = options.map(o => `<option value="${o}">${o}</option>`).join('');
                        itemNameContainer.innerHTML = '';
                        itemNameContainer.appendChild(select);

                        // Adiciona evento para atualizar o item quando o novo select muda
                        select.addEventListener('change', () => updateItem(itemId));
                    });
                }

                updateItemsJson();
            }

            function removeItem(itemId) {
                const itemElement = document.getElementById(`item-${itemId}`);
                if (itemElement) {
                    itemElement.remove();
                }
                items.splice(items.findIndex(item => item.id === itemId), 1);
                updateItemsJson();
            }

            function updateItem(itemId) {
                const itemElement = document.getElementById(`item-${itemId}`);
                const item = items.find(item => item.id === itemId);
                if (item && itemElement) {
                    itemElement.querySelectorAll('.item-input').forEach(input => {
                        item[input.getAttribute('data-field')] = input.value;
                    });
                }
                updateItemsJson();
            }

            function updateItemsJson() {
                document.getElementById('itemsJson').value = JSON.stringify(items);
            }

            document.getElementById('addPokemon').addEventListener('click', () => addItemToForm('pokemon'));
            document.getElementById('addItem').addEventListener('click', () => addItemToForm('item'));

            // Usar o handleFormSubmit do helpers.js
            handleFormSubmit('createPostForm', '{{ route("posts.store") }}', {
                title: { required: true, minLength: 2, maxLength: 25 },
                description: { required: true, minLength: 2, maxLength: 1000 },
                items: { required: true }
            }, 
            (data) => {
                // On success
                window.location.href = data.redirect;
            },
            (error) => {
                // On error
                alert(error);
            });

            animateElements('.bg-card', { y: 50, duration: 0.8 });
        });
    </script>
</x-app-layout>
