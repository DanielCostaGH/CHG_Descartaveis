<template>
    <section class="w-full cursor-pointer">
        <div class="bg-white p-8 rounded-lg shadow-md w-full group hover:shadow-lg">
            
            <div class="flex justify-between cursor-pointer" @click="toggleSection">
                <h3 class="text-xl font-semibold text-gray-500 mb-4 " >Principais Categorias</h3>

                <img :src="down_arrow" alt="">
            </div>
            <!-- Lista de Categorias Atuais -->
            <div v-if="isOpen" class="flex flex-wrap -mx-2 border-t pt-5">
                <div v-for="(category, index) in editedCategories" :key="index" class="w-full mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <!-- Campo de Seleção de Categoria -->
                        <select v-model="editedCategories[index].selectedCategory"
                            class="w-2/6 p-2 border bg-white rounded-l focus:outline-none focus:ring focus:border-blue-500">
                            <option value="" disabled>Selecione uma categoria</option>
                            <option v-for="(option, optionIndex) in categoryOptions" :key="optionIndex" :value="option.id">
                                {{ option.name }}
                            </option>
                        </select>

                        <!-- Campo de Imagem da Categoria -->
                        <input type="file" @change="onCategoryImageInputChange($event, index)"
                            class="w-3/6 p-2 border border-gray-300 rounded-r focus:outline-none focus:ring focus:border-blue-500" />
                    </div>
                </div>
                <!-- Botão para Salvar Alterações -->
                <button @click="saveChanges" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mt-4">
                    Salvar Alterações
                </button>
            </div>


        </div>
    </section>
</template>
  
<script>
export default {
    data() {
        return {
            down_arrow: '/images/down_arrow.svg',
            isOpen: false,
            categories: [], 
            editedCategories: [],
            categoryOptions: [], 
        };
    },
    created() {
        // Simular o carregamento das categorias atuais do banco de dados
        this.loadCategories();
        // Simular o carregamento das opções de categorias do banco de dados
        this.loadCategoryOptions();
    },
    methods: {
        toggleSection() {
            this.isOpen = !this.isOpen;
        },
        loadCategories() {
        // Troca essa parte aqui pela lógica real do backend pra buscar no banco de dados

            this.categories = [
                { selectedCategory: null, image: null },
                { selectedCategory: null, image: null },
                { selectedCategory: null, image: null },
                { selectedCategory: null, image: null },
            ];
            this.editedCategories = this.categories.map(category => ({ ...category }));
        },
        loadCategoryOptions() {
        // Troca essa parte aqui pela lógica real do backend pra buscar no banco de dados

            this.categoryOptions = [
                { id: 1, name: 'Categoria A' },
                { id: 2, name: 'Categoria B' },
                { id: 3, name: 'Categoria C' },
                { id: 4, name: 'Categoria D' },
            ];
        },
        onCategoryImageInputChange(event, index) {
            const file = event.target.files[0];
            if (file) {
        // Manipular a seleção de imagem da categoria pelo usuário
                this.editedCategories[index].image = URL.createObjectURL(file);
            } else {
                // Limpar a imagem se o usuário remover a seleção
                this.editedCategories[index].image = null;
            }
        },
        saveChanges() {
        // Enviar as categorias editadas de volta ao servidor
        // Troca essa parte aqui pela lógica real do backend pra buscar no banco de dados

            console.log('Categorias editadas:', this.editedCategories);
            alert('Alterações salvas com sucesso!');
        },
    },
};
</script>
  
  