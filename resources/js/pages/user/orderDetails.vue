<template>
  <div>
    <navbar />
    <div class="container mx-auto my-5 flex">
      <div class="flex flex-col md:flex-row w-4/6">
        <!-- Seção de detalhes do pedido -->
        <div class="flex-grow">
          <div class="mx-5  p-5">
            <!-- Se o pedido estiver disponível -->
            <v-card v-if="order" class="my-5 h-full">
              <!-- Conteúdo do pedido -->
              <div class="p-7 text-h5 font-weight-bold flex items-center" style="background-color: #F5F5F5;">
                <v-icon color="#2B9D44">mdi-file-search</v-icon>
                <span class="text-gray-600 mx-4">INFORMAÇÕES DO SEU PEDIDO</span>
              </div>
              <v-card-text>
                <!-- Detalhes do pedido -->
                <v-list two-line>
                  <!-- Dados pessoais -->
                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-title>Dados pessoais</v-list-item-title>
                      <v-list-item-subtitle v-if="user">Nome: {{ user.name }}</v-list-item-subtitle>
                      <v-list-item-subtitle v-if="user">CPF/CNPJ: {{ user.document }}</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                  <!-- Endereço de Entrega -->
                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-title>Endereço de Entrega</v-list-item-title>
                      <v-list-item-subtitle v-if="userAddress">
                        {{ userAddress.street }}, {{ userAddress.number }} - {{ userAddress.neighborhood }}, {{ userAddress.city }}, {{ order.address.state }}
                      </v-list-item-subtitle>
                      <v-list-item-subtitle v-else>
                        Endereço não disponível
                      </v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                  <!-- Método de Pagamento -->
                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-title>Método de Pagamento</v-list-item-title>
                      <v-list-item-subtitle>{{ order.paymentMethod }}</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                  <!-- Produtos -->
                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-title class="font-weight-bold mt-5">Produtos:</v-list-item-title>
                      <!-- Loop pelos produtos -->
                      <div v-for="product in order.products" :key="product.id" class="p-5 my-5 shadow-lg flex items-center justify-between">
                        <div class="flex items-center">
                          <div class="mx-5 mr-10 w-[10vh] flex justify-center items-center">
                            <img :src="product.imagePath" alt="Imagem do Produto" class="max-h-[10vh]">
                          </div>
                          <div>
                            <h1 class="font-weight-bold">{{ product.name }}</h1>
                            <v-label>preço: {{ product.price }}, variação: {{ product.variation }}, cor: {{ product.color }}</v-label>
                          </div>
                        </div>
                      </div>
                    </v-list-item-content>
                  </v-list-item>
                </v-list>
              </v-card-text>
            </v-card>
            <!-- Se não houver pedido -->
            <v-card v-else class="my-5 h-full">
              <v-card-text>
                <p>Nenhum pedido encontrado.</p>
              </v-card-text>
            </v-card>
          </div>
        </div>
      </div>
      <!-- Seção de pagamento -->
      <div class="w-2/6 min-h-[50vh] shadow-lg">
        <span>Aqui vai o pagamento</span>
        <p v-if="order">Order ID: {{ order.id }}</p>
        <p v-if="transaction">transaction: {{ transaction.pix_copy_paste }}</p>
        <div v-if="transaction" class="qr-code-container">
          <qrcode-vue :value="transaction.pix_base64" class="qr-code"></qrcode-vue>
        </div>
        <p v-if="userAddress">userAddress: {{ userAddress }}</p>
        <p v-if="user">user: {{ user.id }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import navbar from '../../components/navbar/navbar.vue';
import cartSummary from '../../components/cart-summary.vue';
import QRCodeVue from 'qrcode.vue';  // Importe o componente QRCodeVue

export default {
  props: {
    order: Object,
    user: Object,
    userAddress: Object,
    transaction: Object,
  },
  components: {
    navbar,
    cartSummary,
    'qrcode-vue': QRCodeVue,  // Registre o componente com o nome 'qrcode-vue'
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
      const orderData = JSON.parse(localStorage.getItem('orders'));
      const simplifiedOrder = {
        userId: orderData.userData.id,
        addressId: orderData.address.id,
        paymentMethod: orderData.paymentMethod.id,
        products: orderData.products.map(product => ({
          id: product.id,
          quantity: product.quantity
        })),
        total: orderData.total
      };

      axios.post('/api/create-order', simplifiedOrder)
        .then(response => {
          // Manipula a resposta
        })
        .catch(error => {
          // Manipula o erro
        });
    }
  },
};
</script>
<style>
.qr-code-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.qr-code {
  width: 500px; /* Defina a largura desejada */
  height: 500px; /* Defina a altura desejada */
}
</style>
