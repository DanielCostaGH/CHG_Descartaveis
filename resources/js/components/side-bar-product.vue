<template>
    <div class="mx-auto md:w-5/6 border-2 mt-14 p-8 rounded-md">
        <div class="flex justify-between">
            <div class="p-2 md:p-4 bg-[#5AC15C] text-white font-bold text-2xl rounded">
                <span>R${{ product.price }}</span>
            </div>

            <div class="p-2 md:p-4 text-gray-700 font-bold text-xl rounded cursor-pointer border-2">
                <span> {{ product.brand }}</span>
            </div>
        </div>


        <div class="mt-5">
            <div>
                <v-label>Cores disponíveis</v-label>
                <v-row class="my-4">
                    <v-col v-for="(color, index) in colors" :key="index" cols="3" class="pa-2 d-flex justify-center">
                    <div @click="selectColor(color.name)"
                         :class="{ 'color-selected': selectedColor === color.name }">
                        <div class="rounded-circle shadow-lg"
                             :style="{ backgroundColor: color.value, width: '60px', height: '60px' }"></div>
                    </div>
                </v-col>

                </v-row>
            </div>

            <div>
                <v-label>Variações</v-label>
                <v-row>
                    <v-col cols="12">
                <v-select v-model="selectedVariation" :items="productVariations" label="Veja as variações"></v-select>
            </v-col>
                </v-row>

                <div>
                        <v-btn color="#2B9D44" block large dark class="my-5 text-h6 font-weight-bold" rounded="lg" style="padding-top: 2rem; padding-bottom: 2rem;">
                            <v-icon left class="mr-3 text-h4" >
                                mdi-whatsapp
                            </v-icon>
                            Comprar
                        </v-btn>
                        <v-btn color="primary" @click="addToCart" block large dark class="my-5 text-h6 font-weight-bold" rounded="lg" style="padding-top: 2rem; padding-bottom: 2rem;">
                            <v-icon left class="mr-3 text-h4" >
                                mdi-cart-outline
                            </v-icon>
                            Adicionar ao Carrinho
                        </v-btn>
                </div>



            </div>
        </div>


    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            PlusSquare: '/images/PlusSquare.svg',
            CashCoin: '/images/CashCoin.svg',
            Search: '/images/search.svg',

            colors: [
                { name: 'Preto', value: '#000000' },
                { name: 'Azul Claro', value: '#CA65FB' },
                { name: 'Verde fds', value: '#407847' },

            ],
            selectedColor: null,
            selectedVariation: null,

        }

    },
    props: {
        product: Object,
    },
    computed: {
        userInfo() {
            return this.$store.state.user;
        },
        productVariations() {
            return this.product.variation.split(';').filter(variation => variation.trim() !== '');
        },
    },
    methods: {
  selectColor(colorName) {
    this.selectedColor = colorName;
  },

  addToCart() {
    const cartItem = {
      color: this.selectedColor,
      variation: this.selectedVariation,
      productId: this.product.id,
      quantity: 1 
    };

    if (this.userInfo) {
      axios.post(`http://localhost/api/add_cart/`, cartItem)
        .then(response => {
          alert("Produto adicionado ao carrinho");
        })
        .catch(error => {
          console.error("Erro ao adicionar produto ao carrinho", error);
        });
    } else {
      this.addToLocalCart(cartItem);
    }
  },

  addToLocalCart(cartItem) {
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    let foundIndex = cart.findIndex(item => item.productId === cartItem.productId && item.color === cartItem.color && item.variation === cartItem.variation);

    if (foundIndex !== -1) {
      cart[foundIndex].quantity += cartItem.quantity; 
    } else {
      cart.push(cartItem); 
    }
    localStorage.setItem('cart', JSON.stringify(cart));
  }
}

}
</script>



<style>

.color-selected {
    border: 2px solid black;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    border-radius: 50%;
    padding: 2px;
}
</style>
