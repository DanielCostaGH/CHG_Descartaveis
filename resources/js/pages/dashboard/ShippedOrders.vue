<template>
    <div class="flex">
      <sidebar />
      <main class="w-4/5 p-6 bg-gray-100">
        <header>
          <painel :orders="orders" />
        </header>
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Payment Method</th>
              <th>Status</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="order in orders" :key="order.id">
              <td>{{ order.id }}</td>
              <td>{{ order.payment_method }}</td>
              <td>{{ order.status }}</td>
              <td>{{ order.total_price }}</td>
            </tr>
          </tbody>
        </table>
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
      this.getShippedOrders();
    },

    methods: {
      getShippedOrders() {
        axios.get('get-shipped-orders')
        .then(response => {
          this.orders = response.data;
          console.log(this.orders);
        })
        .catch(error => {
          console.error('Error fetching shipped orders:', error);
        });
      }
    },
};
</script>
