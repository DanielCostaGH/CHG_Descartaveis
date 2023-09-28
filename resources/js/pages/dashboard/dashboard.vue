<template>
  <div class="flex">
    <!-- Barra lateral -->
    <sidebar />

    <!-- Conteúdo principal -->
    <main class="w-4/5 p-6 bg-gray-100">
      <!-- Header -->
      <header>
        <painel />
      </header>

      <!-- Painel de Visão Geral -->
      <div class="bg-white p-6 rounded-lg shadow mb-6">
        <!-- Exiba os indicadores aqui (número de produtos, categorias, pedidos, etc.) -->
        <!-- Exemplo: -->
        <div class="grid grid-cols-2 gap-4 text-center">
          <div class="bg-gradient-to-br from-blue_gradient-light to-blue_gradient-dark p-4 text-white rounded-lg">
            <h3 class="text-xl font-semibold">Total de Produtos</h3>
            <p class="text-3xl font-bold">100</p>
          </div>
          <div class="bg-gradient-to-br from-purple_gradient-light to-purple_gradient-dark text-white p-4 rounded-lg">
            <h3 class="text-xl font-semibold">Total de Categorias</h3>
            <p class="text-3xl font-bold">10</p>
          </div>
        </div>
      </div>

      <!-- Acesso Rápido às Funcionalidades -->
      <div class="bg-white p-6 rounded-lg shadow mb-6">
        <div class="grid grid-cols-2 gap-4">


          <a href="#" class="flex justify-center items-center p-7 border rounded-lg text-center  text-xl font-bold
            hover:bg-[#F3F4F5] hover:border-[#2A4178] hover:shadow-md text-[#4864A7] hover:text-[#2A4178] ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3.0"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span class="mx-5">Adicionar Produto</span>
          </a>


          <a href="#" class="flex justify-center items-center p-4 border rounded-lg text-center  text-xl font-bold
            hover:bg-[#F3F4F5] hover:border-[#2A4178] hover:shadow-md text-[#4864A7] hover:text-[#2A4178] ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
            <span class="mx-5">Editar Produto</span>

          </a>


        </div>
      </div>
      <!-- ... Resto do código ... -->



      <!-- Listagem de Produtos Recentes -->
      <div class="bg-white p-6 rounded-lg shadow mb-6">

        <h3 class="text-xl font-semibold mb-4">Produtos Recentes</h3>
        <table class="w-full">
          <thead>
            <tr class="text-left">
              <th class=" border-gray-400 bg-gray-200 p-4">Nome do produto</th>
              <th class=" border-gray-400 bg-gray-200 p-4">Preço</th>
              <th class=" border-gray-400 bg-gray-200 p-4">Estoque</th>
              <th class=" border-gray-400 bg-gray-200 p-4">Categoria</th>
              <th class=" border-gray-400 bg-gray-200 p-4">Status</th>
            </tr>
          </thead>

          <tbody class="">
            <tr class="">
              <td class=" border-gray-400 p-4">Produto 1</td>
              <td class=" border-gray-400 p-4">R$ 50</td>
              <td class=" border-gray-400 p-4">100</td>
              <td class=" border-gray-400 p-4">Categoria</td>
              <td class=" border-gray-400 p-4">Ativo</td>
            </tr>

            <tr class="">
              <td class=" border-gray-400 p-4">Produto 1</td>
              <td class=" border-gray-400 p-4">R$ 50</td>
              <td class=" border-gray-400 p-4">100</td>
              <td class=" border-gray-400 p-4">Categoria</td>
              <td class=" border-gray-400 p-4">Ativo</td>
            </tr>

            <tr class="">
              <td class=" border-gray-400 p-4">Produto 1</td>
              <td class=" border-gray-400 p-4">R$ 50</td>
              <td class=" border-gray-400 p-4">100</td>
              <td class=" border-gray-400 p-4">Categoria</td>
              <td class=" border-gray-400 p-4">Ativo</td>
            </tr>

            <tr class="">
              <td class=" border-gray-400 p-4">Produto 1</td>
              <td class=" border-gray-400 p-4">R$ 50</td>
              <td class=" border-gray-400 p-4">100</td>
              <td class=" border-gray-400 p-4">Categoria</td>
              <td class=" border-gray-400 p-4">Ativo</td>
            </tr>

          </tbody>
        </table>
      </div>
      <!-- ... Resto do código ... -->
    </main>
  </div>
</template>

<script>

import sidebar from '../../components/side-bar-dashboard.vue';
import painel from '../../components/painel-bar.vue'

export default {
  data() {
    return {
      logo_light: '/images/logo_light.svg',
      dashboard: '/images/dashboard_icon.svg',
      product: '/images/product_icon.svg',
      appearance: '/images/appearance_icon.svg',
      product_sent: '/images/car_icon.svg',
      order_pending: '/images/shopCart_icon.svg',
      payment: '/images/pay_icon.svg',
      config: '/images/config_icon.svg',
    };
  },
  components: {
    sidebar,
    painel,

  }
};
</script>
