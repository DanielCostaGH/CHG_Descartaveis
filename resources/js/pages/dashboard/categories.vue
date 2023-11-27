<template>
    <div class="flex">
      <!-- Barra lateral -->
      <sidebar />
  
      <!-- Conteúdo principal -->
      <main class="w-4/5 p-6 bg-gray-100">
        <!-- Painel de controle -->
        <painel />

        <!-- Botão para adicionar categoria -->
        <div class="flex justify-end mb-4">
            <button  @click="addCategory" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                <a href="/dashboard/categories/create">Adicionar Categoria</a>
            </button>
        </div>
  
        <!-- Lista de Categorias -->
        <section class="bg-white h-[75vh] overflow-y-scroll">
          <div>
            <div class="bg-white p-4 shadow-md rounded-lg">
              <h2 class="text-xl font-medium">Lista de Categorias</h2>
              <div class="flex flex-wrap">
                <div v-for="(category, index) in categories" :key="index" class="p-4">
                  <div class="">
                    <div class="bg-white border shadow-md rounded-lg p-4 w-[40vh] h-[45vh]">
                      <div class="overflow-x-hidden">
                        <h3 class="text-lg font-medium mt-2">{{ category.name }}</h3>
                      </div>
                      <div>
                        <img :src="`/images/categories/${category.id}/${category.images}`" alt="">
                      </div>
  
                      <!-- Botões de Editar e Excluir -->
                      <div class="mt-4 h-2/6 pb-5 flex justify-around items-center">
                        <a :href="`/dashboard/categories/edit/${category.id}`" class="flex items-center border-2 border-blue-600 text-blue-600 hover hover:text-white hover:bg-blue-600 py-3 px-4 rounded">
                          Editar
                        </a>
  
                        <a @click="confirmDelete(category.id)" class="flex items-center border-2 cursor-pointer border-red-600 text-red-600 hover hover:text-white hover:bg-red-600 py-3 px-4 rounded ml-2">
                          Excluir categoria
                        </a>
                      </div>
  
                      <div v-if="categories.length === 0" class="text-center py-10">
                        Nenhuma categoria encontrada.
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  </template>
  
  <script>
  import sidebar from '../../components/side-bar-dashboard.vue'
  import painel from '../../components/painel-bar.vue'
  import axios from 'axios';
  
  export default {
    props: {
        categories: {
          type: Array,
          default: () => [],
        },
    },
  
    components: {
      sidebar,
      painel,
    },
  
    methods: {
      async confirmDelete(categoryId) {
        if (confirm('Tem certeza que deseja excluir esta categoria?')) {
          await this.deleteCategory(categoryId);
        }
      },
  
      async deleteCategory(categoryId) {
        try {
          await axios.delete(`/dashboard/category/delete/${categoryId}`);
          window.location.href = '/dashboard/categories';
        } catch (error) {
          console.error('Erro ao excluir categoria:', error);
          alert('Houve um erro ao excluir a categoria. Por favor, tente novamente.');
        }
      },
    },
  };
  </script>
  