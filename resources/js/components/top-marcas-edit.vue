<template>
    <section class="w-full">
      <div class="bg-white p-4 rounded-lg shadow-md w-full group hover:shadow-lg">
        <div class="flex justify-between cursor-pointer" @click="toggleSection">
                <h3 class="text-xl font-semibold text-gray-400 mb-4 " >Principais Marcas</h3>

                <img :src="down_arrow" alt="">
            </div>
        <!-- Lista de Marcas Atuais -->
        <div v-if="isOpen" class="flex flex-wrap -mx-2">
          <div v-for="(brand, index) in editedBrands" :key="index" class="w-full mb-4">
            <div class="flex items-center justify-between mb-2">
              <!-- Campo de Seleção de Marca -->
              <select
                v-model="editedBrands[index].selectedBrand"
                class="w-2/6 p-2 border bg-white rounded-l focus:outline-none focus:ring focus:border-blue-500"
              >
                <option value="" disabled>Selecione uma marca</option>
                <option v-for="(option, optionIndex) in brandOptions" :key="optionIndex" :value="option.id">
                  {{ option.name }}
                </option>
              </select>
  
              <!-- Campo de Imagem da Marca -->
              <input
                type="file"
                @change="onBrandImageInputChange($event, index)"
                class="w-3/6 p-2 border border-gray-300 rounded-r focus:outline-none focus:ring focus:border-blue-500"
              />
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
        brands: [], // Marcas atuais carregadas do banco de dados
        editedBrands: [], // Marcas editadas pelo usuário
        brandOptions: [], // Opções de marcas recebidas do banco de dados
      };
    },
    created() {
      // Simular o carregamento das marcas atuais do banco de dados
      this.loadBrands();
      // Simular o carregamento das opções de marcas do banco de dados
      this.loadBrandOptions();
    },
    methods: {
      toggleSection() {
        this.isOpen = !this.isOpen;
      },
      loadBrands() {
        // Simular o carregamento das marcas atuais do banco de dados
        // Substitua esta parte pela lógica real para obter marcas do backend
        this.brands = [
          { selectedBrand: null, image: null },
          { selectedBrand: null, image: null },
          { selectedBrand: null, image: null },
          { selectedBrand: null, image: null },
          { selectedBrand: null, image: null },
        ];
        this.editedBrands = this.brands.map(brand => ({ ...brand }));
      },
      loadBrandOptions() {
        // Simular o carregamento das opções de marcas do banco de dados
        // Substitua esta parte pela lógica real para obter opções de marcas do backend
        this.brandOptions = [
          { id: 1, name: 'Marca A' },
          { id: 2, name: 'Marca B' },
          { id: 3, name: 'Marca C' },
          { id: 4, name: 'Marca D' },
          { id: 5, name: 'Marca E' },
        ];
      },
      onBrandImageInputChange(event, index) {
        const file = event.target.files[0];
        if (file) {
          // Manipular a seleção de imagem da marca pelo usuário
          this.editedBrands[index].image = URL.createObjectURL(file);
        } else {
          // Limpar a imagem se o usuário remover a seleção
          this.editedBrands[index].image = null;
        }
      },
      saveChanges() {
        // Enviar as marcas editadas de volta ao servidor
        // Substitua esta parte pela lógica real para salvar as alterações no backend
        console.log('Marcas editadas:', this.editedBrands);
        alert('Alterações salvas com sucesso!');
      },
    },
  };
  </script>
  
  <style scoped>
  /* Estilos específicos do componente */
  </style>
  