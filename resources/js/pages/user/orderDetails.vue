<template>
  <div>
    <navbar />
    <div class="container mx-auto my-5 flex">
      <div class="flex flex-col md:flex-row w-full">
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
                        {{ this.userAddress.street }}, {{ this.userAddress.number }} - {{ this.userAddress.neighborhood
                        }}, {{ this.userAddress.city }}, {{ this.userAddress.state }}
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
                      <v-list-item-subtitle>{{ this.order.payment_method }}</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>

                  <!-- Seção de pagamento -->
                  <div v-if="order.status == 'pending'"
                    class="flex justify-center items-center p-7">
                    <div class="w-4/6">
                      <h1 class="p-4 bg-green rounded" v-if="order">ID do Pedido: {{ order.id }}</h1>
                      <div v-if="transaction">
                        <div class="flex items-center">
                          <h1 class="p-4 text-lg">Pix copia e cola:</h1>
                          <v-btn size="small" color="indigo" @click="copyPixCode">Copiar código</v-btn>
                        </div>
                        <div class="p-5 shadow border rounded">
                          {{ transaction.pix_copy_paste }}
                        </div>
                      </div>
                    </div>

                    <div class="w-2/6 flex justify-center items-center">
                      <qrcode-vue :value="transaction.pix_base64" style="width: 200px; height: 200px;"></qrcode-vue>
                    </div>
                  </div>

                  <div class="p-4 flex items-center gap-4">
                    <h1 class="p-2 text-lg">Status do Pedido:</h1>
                    <div v-if="order.status === 'paid'"
                      class="font-weight-bold text-lg bg-green p-3 rounded flex items-center gap-3">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                      Pagamento confirmado!
                    </div>

                    <div v-else-if="order.status === 'pending'"
                      class="font-weight-bold text-lg bg-gray-500 text-white p-3 rounded flex items-center gap-3">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                      Pagamento pendente!
                    </div>

                    <div v-else-if="order.status === 'cancelled'"
                      class="font-weight-bold text-lg bg-red-500 text-white p-3 rounded flex items-center gap-3">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                      </svg>
                      Pedido Cancelado!
                    </div>

                    <div v-else-if="order.status === 'shipped'"
                      class="font-weight-bold text-lg bg-blue-500 text-white p-3 rounded flex items-center gap-3">
                      <img src="/images/shippedLight.png" alt="" class="w-10">

                      Pedido Enviado!
                    </div>

                    <div v-else-if="order.status === 'delivered'"
                      class="font-weight-bold text-lg bg-green-700 text-white p-3 rounded flex items-center gap-3">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-10 h-10">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                      Pedido Entregue!
                    </div>
                  </div>

                  <!-- Produtos -->
                  <v-list-item>
                    <v-list-item-content>
                      <v-list-item-title class="font-weight-bold mt-5">Produtos:</v-list-item-title>
                      <!-- Loop pelos produtos -->
                      <div v-for="product in products" :key="product.id"
                        class="p-5 my-5 shadow-lg flex items-center justify-between">
                        <div class="flex items-center">
                          <div class="mx-5 mr-10 w-[10vh] flex justify-center items-center">
                            <img :src="product.imagePath" alt="Imagem do Produto" class="max-h-[10vh]">
                          </div>
                          <div>
                            <h1 class="font-weight-bold">{{ product.name }}</h1>
                            <v-label>preço: {{ product.price }}, variação: {{ product.variation }}, cor: {{
              product.color
                              }}</v-label>
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
    </div>
  </div>
</template>

<script>
import navbar from '../../components/navbar/navbar.vue';
import cartSummary from '../../components/cart-summary.vue';
import QRCodeVue from 'qrcode.vue';

export default {
  data() {
    return {
      order: Object,
      transaction: Object,
      user: Object,
      userAddress: Object,
      products: Object
    }
  },
  props: {
    initialData: Object
  },
  components: {
    navbar,
    cartSummary,
    'qrcode-vue': QRCodeVue,
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
      this.order = this.initialData.order;
      this.transaction = this.initialData.transaction;
      this.user = this.initialData.user;
      this.userAddress = this.initialData.userAddress;
      this.products = this.initialData.products;
      this.products.forEach(product => {
        if (!product.hasOwnProperty('imagePath')) {
          const imageNames = product.images.split(';');
          const firstImageName = imageNames[0];

          const imagePath = `/images/products/${product.id}/${firstImageName}`;

          product.imagePath = imagePath;
        }
      });

      console.log("Products:", this.products);
      console.log("Order:", this.order);
      console.log("Transaction:", this.transaction);
      console.log("User:", this.user);
      console.log("User Address:", this.userAddress);
    },

    copyPixCode() {
      const textToCopy = this.transaction.pix_copy_paste;
      const textarea = document.createElement('textarea');
      textarea.value = textToCopy;
      document.body.appendChild(textarea);
      textarea.select();
      textarea.setSelectionRange(0, 99999);
      document.execCommand('copy');
      document.body.removeChild(textarea);
      alert('Código copiado com sucesso!');
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
  width: 500px;
  height: 500px;
}
</style>
