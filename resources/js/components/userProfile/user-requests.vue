<template>
  <div class="p-10">
    <span class="text-xl  text-gray-700">Meus Pedidos</span>
    <div v-for="(pedido, index) in pedidos" :key="index"
      class="border shadow p-4 rounded-lg mt-4 flex items-center justify-between">
      <div class="flex items-center w-4/6 overlow-x-hidden">
        <img :src="pedido.image" class="w-20 h-20 object-cover rounded mr-4" />
        <div>
          <div class="text-lg font-semibold">{{ pedido.nome }}</div>
          <div class="text-gray-500">Valor: R$ {{ pedido.valor.toFixed(2) }}</div>
          <div class="text-gray-500">Status: {{ pedido.status }}</div>

        </div>
      </div>
      <div class="flex flex-wrap justify-center w-2/6">
        <v-btn  color="blue-darken-1" width="250" class="px-4 py-2 my-3"
          @click="showOrder(index)">
          Ver compra
        </v-btn>
        <v-btn color="blue-darken-4" width="250" class="px-4 py-2"
          @click="avaliarPedido(index)">
          Avaliar
        </v-btn>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      pedidos: [
        { nome: 'Teclado Gamer Slim Silencioso LED RGB', valor: 150.00, status: 'Pendente', image: '/images/products/1/1_1708197393_0.png' },
        { nome: 'Adaptador WiFi Dual Band 2.4 / 5GHz 600Mbps', valor: 120.00, status: 'Entregue', image: '/images/products/1/1_1708197393_0.png' },
      ],
    };
  },
  methods: {
    avaliarPedido(index) {
      // Lógica para avaliar o pedido
    },
    comprarNovamente(index) {
      // Lógica para comprar o mesmo produto novamente
    },
  },
};
</script>

<style scoped>
.flex {
  display: flex;
}</style>
