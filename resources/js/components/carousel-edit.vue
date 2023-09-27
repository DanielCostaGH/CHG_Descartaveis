<template>
    <section class="w-full">
        <div class="bg-white p-4 rounded-lg shadow-md w-full group hover:shadow-lg">
            <div class="flex justify-between cursor-pointer" @click="toggleSection">
                <h3 class="text-xl font-semibold text-gray-400 mb-4 " >Carrossel de Imagens</h3>

                <img :src="down_arrow" alt="">
            </div>


            <div v-if="isOpen" class="mb-4 grid grid-cols-2 gap-4">
                <!-- Conteúdo do acordeão -->
                <div v-for="index in 6" :key="index" class="relative bg-white rounded-lg shadow-md">
                    <div class="p-4">{{ `Imagem ${index}` }}</div>
                    <div class="border border-dashed border-gray-400 p-4">
                        <img :src="getImageSource(index - 1)" alt="Imagem" class="h-[30vh] mx-auto" />
                        <div class="flex justify-between mt-2">
                            <input type="file" @change="onImageInputChange($event, index - 1)"
                                class="w-1/2 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500"
                                ref="fileInput" />
                            <div>
                                <button class="bg-blue-500 text-white p-2 rounded cursor-pointer mx-2">
                                    Salvar
                                </button>
                                <button @click="showDeleteConfirmation(index)" class="text-white bg-red-500 p-2 rounded">
                                    Excluir
                                </button>
                            </div>
                        </div>
                        <!-- Confirmação de Exclusão (inicialmente oculta) -->
                        <div v-if="deleteConfirmation === index" class="mt-2">
                            <p class="text-red-600">Tem certeza que deseja excluir esta imagem?</p>
                            <button @click="deleteImage(index - 1)" class="bg-red-500 text-white px-2 py-1 rounded">
                                Confirmar
                            </button>
                            <button @click="cancelDelete" class="bg-gray-300 text-gray-700 px-2 py-1 rounded ml-2">
                                Cancelar
                            </button>
                        </div>
                    </div>
                </div>
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
            images: [],
            selectedImages: [],
            deleteConfirmation: null,
        };
    },

    methods: {
        toggleSection() {
            this.isOpen = !this.isOpen;
        },

        getImageSource(index) {
            if (this.images[index] && this.images[index].url) {
                return this.images[index].url;
            } else if (this.selectedImages[index]) {
                return URL.createObjectURL(this.selectedImages[index]);
            } else {

                return '/placeholder-image.jpg';
            }
        },

        async onImageInputChange(event, index) {
            const file = event.target.files[0];
            if (file) {
                // Manipular a seleção de imagem pelo usuário
                this.selectedImages[index] = file;
            } else {
                // Limpar a imagem se o usuário remover a seleção
                this.selectedImages[index] = null;
            }
        },

        showDeleteConfirmation(index) {
            this.deleteConfirmation = index;
        },

        // Cancela a confirmação de exclusão.
        cancelDelete() {
            this.deleteConfirmation = null;
        },

        // Exclui a imagem com base no índice.
        deleteImage(index) {
            if (this.images[index] !== undefined) {
                // Fazer uma requisição para excluir a imagem do backend aqui.
                // Após a exclusão bem-sucedida, você pode remover a imagem do array `images`.

                // Após a exclusão bem-sucedida, remova a confirmação de exclusão.
                this.cancelDelete();
            }
        },
    },
};
</script>
  