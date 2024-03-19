<template>
  <div class="flex">
    <sidebar />
    <main class="w-4/5 p-6 bg-gray-100">
      <header>
        <painel :orders="orders" />
      </header>

      <section class="bg-white h-[80vh] shadow rounded-lg overflow-scroll">
        <div class="p-5"><span class="font-weight-bold text-gray-600 text-2xl">Pedidos pendentes de envio</span></div>

        <div class="w-full flex flex-wrap">
          <div v-for="order in orders" :key="order.id" class="border shadow p-6 mx-10 rounded-lg mt-4 w-[40vh]">
            <div class="flex items-center w-full overflow-x-hidden">
              <div class="text-lg font-semibold h-full py-6 px-4 bg-green-500 text-white mx-5 rounded">ID: {{ order.id
                }}</div>
              <div>
                <div class="text-lg">Cliente: {{ order.user.name }}</div>
                <div class="text-lg">Valor: R$ {{ order.total_price }}</div>
                <div class="text-lg text-gray-500">Status: {{ order.status }}</div>
              </div>
            </div>
            <div class="flex flex-wrap justify-center w-full mt-4">
              <v-btn :href="`/dashboard/order-details/${order.id}`" color="blue darken-1" width="250"
                class="px-4 py-2 my-3">
                Ver Pedido
              </v-btn>
            </div>
          </div>

          <div v-for="order in orders" :key="order.id" class="border shadow p-6 mx-10 rounded-lg mt-4 w-[40vh]">
            <div class="flex items-center w-full overflow-x-hidden">
              <div class="text-lg font-semibold h-full py-6 px-4 bg-green-500 text-white mx-5 rounded">ID: {{ order.id
                }}</div>
              <div>
                <div class="text-lg">Cliente: {{ order.user.name }}</div>
                <div class="text-lg">Valor: R$ {{ order.total_price }}</div>
                <div class="text-lg text-gray-500">Status: {{ order.status }}</div>
              </div>
            </div>
            <div class="flex flex-wrap justify-center w-full mt-4">
              <v-btn :href="`/dashboard/order-details/${order.id}`" color="blue darken-1" width="250"
                class="px-4 py-2 my-3">
                Ver Pedido
              </v-btn>
            </div>
          </div>

          <div v-for="order in orders" :key="order.id" class="border shadow p-6 mx-10 rounded-lg mt-4 w-[40vh]">
            <div class="flex items-center w-full overflow-x-hidden">
              <div class="text-lg font-semibold h-full py-6 px-4 bg-green-500 text-white mx-5 rounded">ID: {{ order.id
                }}</div>
              <div>
                <div class="text-lg">Cliente: {{ order.user.name }}</div>
                <div class="text-lg">Valor: R$ {{ order.total_price }}</div>
                <div class="text-lg text-gray-500">Status: {{ order.status }}</div>
              </div>
            </div>
            <div class="flex flex-wrap justify-center w-full mt-4">
              <v-btn :href="`/dashboard/order-details/${order.id}`" color="blue darken-1" width="250"
                class="px-4 py-2 my-3">
                Ver Pedido
              </v-btn>
            </div>
          </div>

          <div v-for="order in orders" :key="order.id" class="border shadow p-6 mx-10 rounded-lg mt-4 w-[40vh]">
            <div class="flex items-center w-full overflow-x-hidden">
              <div class="text-lg font-semibold h-full py-6 px-4 bg-green-500 text-white mx-5 rounded">ID: {{ order.id
                }}</div>
              <div>
                <div class="text-lg">Cliente: {{ order.user.name }}</div>
                <div class="text-lg">Valor: R$ {{ order.total_price }}</div>
                <div class="text-lg text-gray-500">Status: {{ order.status }}</div>
              </div>
            </div>
            <div class="flex flex-wrap justify-center w-full mt-4">
              <v-btn :href="`/dashboard/order-details/${order.id}`" color="blue darken-1" width="250"
                class="px-4 py-2 my-3">
                Ver Pedido
              </v-btn>
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