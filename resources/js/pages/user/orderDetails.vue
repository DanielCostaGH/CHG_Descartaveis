<template>
  
    <navbar />
    <div class="lg:container mx-auto my-5 flex">
      <div class="flex flex-col md:flex-row w-full">
        <!-- Seção de detalhes do pedido -->
        <div class="flex-grow">
          <div class="lg:mx-5 lg:p-5">
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
                  <div v-if="order.status == 'pending'" class="lg:flex justify-center items-center lg:p-7 my-5 lg:my-0">
                    <div class="lg:w-4/6">
                      <h1 class="p-4 bg-green w-full rounded" v-if="order">ID do Pedido: {{ order.id }}</h1>
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

                    <div class="hidden w-2/6 lg:flex justify-center items-center">
                      <qrcode-vue :value="transaction.pix_base64" style="width: 200px; height: 200px;"></qrcode-vue>
                    </div>
                  </div>

                  <div class="lg:p-4 flex items-center gap-4">
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
                      <!-- Produtos Desktop -->
                      <div v-for="product in products" :key="product.id"
                        class="p-5 my-5 shadow-lg flex flex-wrap items-center justify-between hover:border hover:rounded-xl duration-300">
                        <a :href="`/products/${product.id}`" class="flex items-center">
                          <div class="mx-5 mr-10 w-[10vh] flex justify-center items-center">
                            <img :src="product.imagePath" alt="Imagem do Produto" class="max-h-[10vh]">
                          </div>
                          <div>
                            <h1 class="font-weight-bold ">{{ product.name }}</h1>
                            <v-label>
                              preço: {{ product.price }}, variação: {{ product.variation }}
                            </v-label>
                          </div>
                        </a>
                        <v-btn v-if="order.status === 'delivered'" color="indigo" width="150" class="px-4 py-2" @click="startReviewProcess(product.id)">
                          Avaliar
                        </v-btn>
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
 

  <!-- Modal de Avaliação -->
  <v-dialog v-model="showReviewDialog" persistent max-width="600px">
    <v-card>
      <v-card-title class="text-h5">Avaliar Pedido</v-card-title>
      <v-card-text>
        <v-rating v-model="reviewRating" dense color="amber" half-increments hover></v-rating>
        <v-textarea v-model="reviewText" label="Deixe seu feedback" hint="Escreva aqui sua avaliação sobre o pedido."
          persistent-hint auto-grow></v-textarea>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="showReviewDialog = false">Cancelar</v-btn>
        <v-btn color="green darken-1" text @click="submitReview">Enviar Avaliação</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
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
      products: Object,
      showReviewDialog: false,
      currentProductId: null,
      reviewRating: 0,
      reviewText: '',
      userReviews: [],
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
    this.loadOrder()
    this.reviewedProduct()
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
    },

    startReviewProcess(productId) {
      this.currentProductId = productId;

      const previousReview = this.userReviews.find(review => review.product_id === productId);
      if (previousReview) {
        this.reviewRating = previousReview.rating;
        this.reviewText = previousReview.comment || ''; 
      } else {
        this.reviewRating = 0;
        this.reviewText = '';
      }
      this.showReviewDialog = true;
    },


    submitReview() {
      const product = this.currentProductId;
      axios.put('/user/product-review', {
        productId: product,
        rating: this.reviewRating,
        feedback: this.reviewText
      })
        .then(response => {
          alert(response.data.message)
        })
        .catch(error => {
          alert('A avaliação não foi salva', error)
        });

      this.showReviewDialog = false;
      this.reviewRating = 0;
      this.reviewText = '';
      this.reviewedProduct();
    },

    reviewedProduct() {
      axios.get('/user/get-user-reviews')
        .then(response => {
          this.userReviews = response.data
        })
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
