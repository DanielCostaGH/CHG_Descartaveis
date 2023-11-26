<template>
    <section class="w-full">
        <div class="bg-white p-8 rounded-lg shadow-md w-full group hover:shadow-lg">
            <div class="flex justify-between cursor-pointer" @click="toggleSection">
                <h3 class="text-xl font-semibold text-gray-500 mb-4 " >Editar Rodapé</h3>

                <img :src="down_arrow" alt="">
            </div>
            <div v-if="isOpen" class="border-t pt-5">
                <div class="grid grid-cols-2 gap-4">
                    <!-- Campo de Whatsapp -->
                    <div class="mb-4">
                        <label for="whatsapp" class="block text-gray-700">Whatsapp:</label>
                        <input type="text" id="whatsapp" v-model="whatsapp"
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500" />
                    </div>

                    <!-- Campo de Telefone -->
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700">Telefone:</label>
                        <input type="text" id="phone" v-model="phone"
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500" />
                    </div>

                    <!-- Campo de Instagram -->
                    <div class="mb-4">
                        <label for="instagram" class="block text-gray-700">Instagram:</label>
                        <input type="text" id="instagram" v-model="instagram"
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500" />
                    </div>

                    <!-- Campo de Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700">Email:</label>
                        <input type="text" id="email" v-model="email"
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500" />
                    </div>
                </div>

                <!-- Campo de Imagem da Logo -->
                <div class="mb-4">
                    <label for="logo" class="block text-gray-700">Logo (Imagem):</label>
                    <input type="file" @change="onLogoInputChange($event)" id="logo"
                        class="w-1/2 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500" />
                </div>

                <!-- Pré-visualização da imagem da Logo -->
                <div class="mb-4" v-if="logoImage">
                    <label class="block text-gray-700">Pré-visualização da Logo:</label>
                    <img :src="logoImage" alt="Logo" class="h-[30vh] p-5 border" />
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
            isOpen: false,
            whatsapp: '', 
            phone: '', 
            instagram: '', 
            email: '', 
            logoImage: null, 
            down_arrow: '/images/down_arrow.svg',
        };
    },
    methods: {
        toggleSection() {
            this.isOpen = !this.isOpen;
        },
        onLogoInputChange(event) {
            const file = event.target.files[0];
            if (file) {
                // Manipular a seleção de imagem da logo pelo usuário
                this.logoImage = URL.createObjectURL(file);
            } else {
                // Limpar a imagem se o usuário remover a seleção
                this.logoImage = null;
            }
        },
        saveChanges() {
        // Enviar os valores editados do Footer de volta ao servidor
        // Troca essa parte aqui pela lógica real do backend pra buscar no banco de dados

            const data = {
                whatsapp: this.whatsapp,
                phone: this.phone,
                instagram: this.instagram,
                email: this.email,
                logoImage: this.logoImage,
            };
            alert('Alterações salvas com sucesso!');
        },
    },
};
</script>
  