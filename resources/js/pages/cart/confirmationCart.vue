<template>
  <navbar />
  <div class="container mx-auto my-5">
    <div class="flex flex-col md:flex-row">
      <div class="flex-grow">
        <div class="mx-5  p-5">
          <v-card class="my-5 h-full">
            <div class="p-7 text-h5 font-weight-bold flex items-center" style="background-color: #F5F5F5;">
              <v-icon color="#2B9D44">mdi-file-search</v-icon>
              <span class="text-gray-600 mx-4">INFORMAÇÕES DO SEU PEDIDO</span>
            </div>
            <v-card-text v-if="order">
              <v-list two-line>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title>Dados pessoais</v-list-item-title>
                    <v-list-item-subtitle>Nome: {{ order.userData.name }}</v-list-item-subtitle>
                    <v-list-item-subtitle>CPF/CNPJ: {{ order.userData.document }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title>Endereço de Entrega</v-list-item-title>
                    <v-list-item-subtitle>{{ order.address.street }}, {{ order.address.number }} - {{
                      order.address.neighborhood }}, {{ order.address.city }}, {{ order.address.state
  }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title>Método de Pagamento</v-list-item-title>
                    <v-list-item-subtitle>{{ order.paymentMethod }}</v-list-item-subtitle>
                  </v-list-item-content>
                </v-list-item>
                <v-list-item>
                  <v-list-item-content>
                    <v-list-item-title class="font-weight-bold mt-5">Produtos:</v-list-item-title>
                    <div v-for="product in order.products" :key="product.id"
                      class="p-5 my-5 shadow-lg flex items-center justify-between">
                      <div class="flex items-center">
                        <div class="mx-5 mr-10 w-[10vh] flex justify-center items-center">
                          <img :src="product.imagePath" alt="Imagem do Produto" class="max-h-[10vh]">
                        </div>

                        <div>
                          <h1 class="font-weight-bold">{{ product.name }}</h1>
                          <v-label>preço: {{ product.price }}, variação: {{ product.variation }}, cor: {{
                            product.color }}</v-label>
                        </div>
                      </div>
                    </div>
                  </v-list-item-content>
                </v-list-item>

              </v-list>
            </v-card-text>
            <v-card-text v-else>
              <p>Nenhum pedido encontrado.</p>
            </v-card-text>
          </v-card>
        </div>
      </div>
      <cartSummary :totalPrice="totalPrice" @confirmPurchase="saveOrder" />
    </div>
  </div>
</template>

<script>
import navbar from '../../components/navbar/navbar.vue';
import cartSummary from '../../components/cart-summary.vue';

export default {
  data() {
    return {
      order: null,
    };
  },

  components: {
    navbar,
    cartSummary,
  },

  computed: {
    totalPrice() {
      return this.order ? this.order.total : '0.00';
    },
  },

  mounted() {
    this.loadOrder();
  },

  methods: {
    loadOrder() {
      const orderString = localStorage.getItem('order');
      if (orderString) {
        this.order = JSON.parse(orderString);
      }
    },


    saveOrder() {
      const orderData = JSON.parse(localStorage.getItem('order'));
      const simplifiedOrder = {
        userId: orderData.userData.id,
        addressId: orderData.address.id,
        paymentMethod: orderData.paymentMethod,
        products: orderData.products.map(product => ({
          id: product.id,
          quantity: product.quantity
        })),
        total: orderData.total
      };

      axios.post('/api/save-order', simplifiedOrder)
        .then(response => {
          console.log(response.data.id)
          window.location.href = `/user/order-details/${response.data.id}`
        })
        .catch(error => {
        });


    }
  },
};
</script>


