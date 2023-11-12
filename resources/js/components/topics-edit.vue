<template>
    <section class="w-full">
      <div class="bg-white p-8 rounded-lg shadow-md w-full group hover:shadow-lg">
        <div class="flex justify-between cursor-pointer" @click="toggleSection">
          <h3 class="text-xl font-semibold text-gray-500 mb-4">Principais Tópicos</h3>
          <img :src="down_arrow" alt="" />
        </div>
  
        <div v-if="isOpen" class="border-t pt-5">
          <!-- Lista de Tópicos Atuais -->
          <div class="flex flex-wrap -mx-2">
            <div v-for="(topic, index) in editedTopics" :key="index" class="w-1/2 px-2 mb-4">
              <!-- Campo de Seleção de Tópico -->
              <select v-model="editedTopics[index]"
                class="bg-white w-full p-2 border border-gray-300 rounded ">
                <option value="" disabled>Selecione um tópico</option>
                <option v-for="(option, optionIndex) in topicOptions" :key="optionIndex" :value="option">
                  {{ option }}
                </option>
              </select>
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
        isOpen: true,
        topics: [], // Tópicos atuais carregados do banco de dados
        editedTopics: [], // Tópicos editados pelo usuário
        topicOptions: [], // Opções de tópicos a serem carregadas do banco de dados
      };
    },
    created() {
      // Simular o carregamento dos tópicos atuais do banco de dados
      this.loadTopics();
      // Simular o carregamento das opções de tópicos do banco de dados
      this.loadTopicOptions();
    },
    methods: {
      toggleSection() {
        this.isOpen = !this.isOpen;
      },
      loadTopics() {
        // Troca essa parte aqui pela lógica real do backend pra buscar no banco de dados
        this.topics = ['Tópico 1', 'Tópico 2', 'Tópico 3', 'Tópico 4'];
        this.editedTopics = [...this.topics];
      },
      loadTopicOptions() {
        // Troca essa parte aqui pela lógica real do backend pra buscar no banco de dados
        this.topicOptions = ['Tópico A', 'Tópico B', 'Tópico C', 'Tópico D'];
      },
      saveChanges() {
        // Enviar os tópicos editados de volta ao servidor
        // Troca essa parte aqui pela lógica real do backend pra buscar no banco de dados
        console.log('Tópicos editados:', this.editedTopics);
        alert('Alterações salvas com sucesso!');
      },
    },
  };
  </script>
  
  