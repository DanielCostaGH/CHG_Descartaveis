<template>
  <div class="flex">
    <sidebar />
    <main class="w-4/5 p-6 bg-gray-100">
      <header>
        <painel :orders="orders" />
      </header>

      <section class="bg-white h-[80vh] shadow rounded-lg overflow-auto">
        <div class="p-5">
          <div class="p-5 ">
            <span class="font-weight-bold text-gray-600 text-2xl">Pedidos pendentes de envio</span>
          </div>
         

          <v-table class="custom-table-body my-20">
            <template v-slot:default>
              <thead>
                <tr>
                  <th class="text-left">ID do Pedido</th>
                  <th class="text-left">Nome do Cliente</th>
                  <th class="text-left">Status</th>
                  <th class="text-left">Valor Total</th>
                  <th class="text-left">Método de Pagamento</th>
                  <th class="text-left"></th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="order in orders" :key="order.id">
                  <td>{{ order.id }}</td>
                  <td>{{ order.user.name }}</td>
                  <td>{{ order.status }}</td>
                  <td>{{ order.total_price }}</td>
                  <td>{{ order.payment_method }}</td>
                  <td><a :href="`/dashboard/order-details/${order.id}`"><v-icon>mdi-eye</v-icon></a></td>
                </tr>
              </tbody>
            </template>
          </v-table>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import sidebar from '../../components/side-bar-dashboard.vue';
import painel from '../../components/painel-bar.vue';
import axios from 'axios';

export default {
  data() {
    return {
      orders: [],
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
      axios.get('/dashboard/get-shipped-orders')
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


<style>
.custom-table-body {
  max-height: 40vh !important;
  overflow-y: auto;
}
</style>