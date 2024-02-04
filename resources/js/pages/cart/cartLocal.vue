<template>
    <navbar />

    <!-- DESKTOP -->
    <div class="container mx-auto my-5 hidden lg:block">
        <div class="flex h-[60vh]">
            <div class="w-4/6">

                <div class="p-4 flex shadow-lg rounded-lg mx-5 my-10 justify-between">
                    <v-label>Nenhum endereço principal definido.</v-label>
                    <v-btn href="/user/login" text color="primary">Adicionar Endereço</v-btn>
                </div>

                <div class="mx-5 my-10 shadow-lg rounded-lg p-5">

                    <div v-if="empty">
                        <v-label class="text-h6">Carrinho vazio. Adicione produtos!</v-label>
                    </div>
                    <div v-for="product in products" :key="product.id"
                        class="p-5 my-5 shadow-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="mx-5 mr-10 w-[10vh] flex justify-center items-center">
                                <img :src="product.imagePath" alt="Imagem do Produto" class="max-h-[10vh]">
                            </div>

                            <div>
                                <h1>{{ product.name }}</h1>
                                <v-label>preço: {{ product.price }}</v-label> <br>
                                <v-label>variação: {{ product.variation }}</v-label> <br>
                                <v-label>cor: {{ product.color }}</v-label>

                                <div class="flex">
                                    <div class="flex gap-4">
                                        <button @click="decreaseQuantity(product)">
                                            <v-icon>mdi-minus-circle-outline</v-icon>
                                        </button>

                                        <div>
                                            <span v-text="product.quantity"></span>
                                        </div>

                                        <button @click="increaseQuantity(product)">
                                            <v-icon>mdi-plus-circle-outline</v-icon>
                                        </button>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div>
                            <button @click="removeProduct(product)">
                                <v-icon size="25" class="hover hover:bg-indigo">mdi-delete-outline</v-icon>
                            </button>
                        </div>


                    </div>
                </div>

            </div>


            <cartSummary :totalPrice="totalPrice" />
        </div>
    </div>

     <!-- MOBILE SECTION -->
     <div class="lg:hidden">
        <div class="flex flex-wrap">
            <div class="w-full">

                <div class="p-4 flex shadow-lg rounded-lg mx-5 my-10 justify-between">
                    <v-btn href="/user/login" text color="primary">Adicionar Endereço</v-btn>
                </div>

                <div class="my-10 p-2">

                    <div v-if="empty">
                        <v-label class="text-h6 break-line">Carrinho vazio. Adicione produtos!</v-label>
                    </div>
                    
                    <div v-for="product in products" :key="product.id"
                        class="py-5 shadow-lg flex items-center justify-between">

                        <div class="flex items-center">
                            <div class="mx-5 mr-10 w-[10vh] flex justify-center items-center">
                                <img :src="product.imagePath" alt="Imagem do Produto" class="max-h-[10vh]">
                            </div>

                            <div>
                                <a :href="`/products/${product.id}`" class="product-link">{{ product.name }}</a> <br>
                                <v-label class="break-line">preço: {{ product.price }}, variação: {{ product.variation }}, cor: {{
                                    product.color }}</v-label>

                                <div class="flex">
                                    <div class="flex gap-4">
                                        <button @click="decreaseQuantity(product)">
                                            <v-icon>mdi-minus-circle-outline</v-icon>
                                        </button>

                                        <div>
                                            <span v-text="product.quantity"></span>
                                        </div>

                                        <button @click="increaseQuantity(product)">
                                            <v-icon>mdi-plus-circle-outline</v-icon>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div>
                            <button @click="removeProduct(product)">
                                <v-icon size="25" class="hover hover:bg-indigo mx-4">mdi-delete-outline</v-icon>
                            </button>
                        </div>


                    </div>
                </div>

            </div>

            <div class="lg:block flex mx-auto w-full">
                <cartSummary :totalPrice="totalPrice" :products="products" :selectedMainAddress="selectedMainAddress" />
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import navbar from '../../components/navbar/navbar.vue'
import cartSummary from '../../components/cart-summary.vue'


export default {
    data() {
        return {
            products: [],
            empty: false,
        };
    },


    components: {
        navbar,
        cartSummary,

    },

    computed: {
        totalPrice() {
            return this.products.reduce(
                (total, product) => total + product.price * product.quantity,
                0
            ).toFixed(2);
        },
    },


    methods: {

        loadLocalCart() {
            const localCart = localStorage.getItem('cart');
            if (localCart) {
                const cartItems = JSON.parse(localCart);
                const productIds = cartItems.map(item => item.productId);
                this.fetchLocalCartProducts(productIds);
            } else {
                this.products = [];
                this.checkEmptyCart();
            }
        },

        fetchLocalCartProducts(productIds) {
            axios.post('/api/get_local_cart_products', { productIds })
                .then(response => {
                    const localCart = JSON.parse(localStorage.getItem('cart'));
                    this.products = response.data.map(product => {
                        const localCartItem = localCart.find(item => item.productId === product.id);
                        return {
                            ...product,
                            quantity: localCartItem ? localCartItem.quantity : 0,
                            color: localCartItem ? localCartItem.color : '', 
                            variation: localCartItem ? localCartItem.variation : '',
                        };
                    });
                    this.checkEmptyCart();
                })
                .catch(error => {
                    console.error("Erro ao recuperar produtos do carrinho local", error);
                });
        },


        checkEmptyCart() {
            this.empty = this.products.length === 0;
        },

        updateCartItemQuantity(cartItemId, newQuantity) {
            axios.put(`/api/update_cart_item/${cartItemId}`, { quantity: newQuantity })
                .catch(error => {
                    console.error("Erro ao atualizar a quantidade", error);
                });
        },

        increaseQuantity(product) {
            let localCart = JSON.parse(localStorage.getItem('cart'));
            let item = localCart.find(item => item.productId === product.id);
            if (item) {
                item.quantity++;
            }
            localStorage.setItem('cart', JSON.stringify(localCart));
            this.loadLocalCart();
        },

        decreaseQuantity(product) {
            let localCart = JSON.parse(localStorage.getItem('cart'));
            let item = localCart.find(item => item.productId === product.id);
            if (item && item.quantity > 1) {
                item.quantity--;
            }
            localStorage.setItem('cart', JSON.stringify(localCart));
            this.loadLocalCart();
        },
        removeProduct(productToRemove) {
            let localCart = JSON.parse(localStorage.getItem('cart'));
            localCart = localCart.filter(item => item.productId !== productToRemove.id);
            localStorage.setItem('cart', JSON.stringify(localCart));

            this.loadLocalCart();
        },
        emptyCart() {
            if (this.products.length == 0) {
                this.empty = true;
            }

        },

    },

    mounted() {
        this.loadLocalCart()
    }

};
</script>


<style>
.avatar-img {
    width: 50px;
    margin-right: 10px;
}
</style>
