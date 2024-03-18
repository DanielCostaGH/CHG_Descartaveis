<template>
  <div class="p-10 max-h-[70vh] overflow-scroll">
    <span class="text-xl text-gray-700">Meus Pedidos</span>
    <div v-for="(order, index) in orders" :key="index"
      class="border shadow p-4 rounded-lg mt-4 flex flex-col md:flex-row items-center justify-between">
      <div class="flex items-center w-full md:w-4/6 overflow-x-hidden">
        <img :src="`/images/products/${order.products[0].id}/${order.products[0].images}`" class="w-20 h-20 object-cover rounded mr-4" />
        <div>
          <div class="text-lg font-semibold">{{ order.products[0].name }}</div>
          <div class="text-gray-500">Valor: R$ {{ order.total_price }}</div>
          <div class="text-gray-500">Status: {{ order.status }}</div>
        </div>
      </div>
      <div class="flex flex-wrap justify-center w-full md:w-2/6 mt-4 md:mt-0">
        <v-btn :href="`/user/order-details/${order.id}`" color="blue darken-1" width="250" class="px-4 py-2 my-3">
          Ver compra
        </v-btn>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      orders: [],
    };
  },
  mounted() {
    this.getUserOrders();
  },
  methods: {
    getUserOrders() {
      axios.get('/user/get-orders')
        .then(response => {
          this.orders = response.data;
        })
        .catch(error => console.error("Erro ao buscar pedidos:", error));
    },
  },
};
</script>
