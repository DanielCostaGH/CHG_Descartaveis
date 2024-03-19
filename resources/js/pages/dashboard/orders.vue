<template>
  <div class="flex">
    <sidebar />
    <main class="w-4/5 p-6 bg-gray-100">
      <header>
        <painel :orders="orders" />
      </header>

      <section class="bg-white h-screen rounded-lg">
        <div class="p-5"><span class="font-weight-bold text-gray-600 text-2xl">Pedidos pendentes de envio</span></div>
        <div v-for="order in orders" :key="order.id"
          class="border shadow p-4 rounded-lg mt-4 flex flex-col md:flex-row items-center justify-between">
          <div class="flex items-center w-full md:w-4/6 overflow-x-hidden">
            <img :src="`/images/products/${order.products[0].id}/${order.products[0].images}`"
              class="w-20 h-20 object-cover rounded mr-4" />
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
      </section>
    </main>
  </div>
</template>

<script>
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'
import axios from 'axios';

export default {
  data() {
    return {
      orders: []
    };
  },

  components: {
    sidebar,
    painel,
  },

  mounted() {
    this.getPendingOrders();
  },

  methods: {
    getPendingOrders() {
      axios.get('get-pending-orders')
        .then(response => {
          this.orders = response.data;
        })
        .catch(error => {
          console.error('Error fetching pending orders:', error);
        });
    }
  },
};
</script>