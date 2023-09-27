<template>
    <section class="w-full ">
        <div class="bg-white p-4 rounded-lg shadow-md w-full group hover:shadow-lg">
            
            <div class="flex justify-between cursor-pointer" @click="toggleSection">
                <h3 class="text-xl font-semibold text-gray-400 mb-4 " >Principais Tópicos</h3>

                <img :src="down_arrow" alt="">
            </div>

            <div v-if="isOpen">
                <!-- Lista de Tópicos Atuais -->
                <div class="flex flex-wrap -mx-2">
                    <div v-for="(topic, index) in editedTopics" :key="index" class="w-1/2 px-2 mb-4">
                        <input type="text" v-model="editedTopics[index]" @input="onTopicInputChange(index)"
                            class="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500" />
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
            isOpen: false, // Controla a visibilidade do acordeão
            topics: [], // Tópicos atuais carregados do banco de dados
            editedTopics: [], // Tópicos editados pelo usuário
        };
    },
    created() {
        // Simular o carregamento dos tópicos atuais do banco de dados
        this.loadTopics();
    },
    methods: {
        loadTopics() {
            // Simular o carregamento dos tópicos atuais do banco de dados
            // Substitua esta parte pela lógica real para obter tópicos do backend
            this.topics = ['Tópico 1', 'Tópico 2', 'Tópico 3', 'Tópico 4'];
            this.editedTopics = [...this.topics];
        },
        onTopicInputChange(index) {
            // Manipular a edição de um tópico pelo usuário
        },
        saveChanges() {
            // Enviar os tópicos editados de volta ao servidor
            // Substitua esta parte pela lógica real para salvar as alterações no backend
            console.log('Tópicos editados:', this.editedTopics);
            alert('Alterações salvas com sucesso!');
        },
        toggleSection() {
            this.isOpen = !this.isOpen; // Alterna a visibilidade do acordeão
        },
    },
};
</script>
  
<style scoped>
/* Estilos específicos do componente */
</style>
  