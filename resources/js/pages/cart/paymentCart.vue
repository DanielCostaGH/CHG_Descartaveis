<template>
    <navbar/>

    <div class="container mx-auto my-5">

    <div class="flex h-[60vh]">
        <div class="w-4/6">
            <div class="p-4 flex shadow-lg rounded-lg mx-5 my-10">

            </div>

            <div class="mx-5 my-10 shadow-lg rounded-lg p-5">


            </div>
        </div>

        <div class="w-2/6 mx-5 my-10 rounded-lg shadow-lg">
            <!-- Resumo -->

            <div>

            </div>
            <div class="p-7 text-h5 font-weight-bold flex items-center">
                <v-icon color="#2B9D44">mdi-file-search</v-icon>
                <span class="text-gray-600 mx-4">Resumo</span>
            </div>

            <div class="p-7">
                <span class="font-weight-bold">Valor dos Produtos: <span class="p-2 text-white rounded bg-primary">R$ {{
                    totalPrice }}</span></span>
                <hr class="my-5">
                <div class="py-5">
                    <v-label class="font-weight-bold">Frete: <span class="p-2">R$ 00,00</span></v-label> <br>
                </div>
                <span class="font-weight-bold">Valor total: <span class="p-2 text-white rounded bg-warning">R$ {{ totalPrice
                }}</span> </span>
            </div>

            <div class="w-5/6 mx-auto px-5">
                <v-btn :href="userInfo ? `/cart/confirmation/${userInfo.id}` : '#'" color="#2B9D44" block large dark class="my-5 text-h6" rounded="lg"
                    style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
                    <v-icon left class="mr-3 text-h4">
                        mdi-cash
                    </v-icon>
                    Continuar
                </v-btn>

                <v-btn  :href="userInfo ? `/cart/${userInfo.id}` : '#'" color="primary" block large dark class="my-5 text-h6" rounded="lg"
                    style="padding-top: 1.6rem; padding-bottom: 1.6rem;" >
                    <v-icon left class="mr-3 text-h4">
                        mdi-cash
                    </v-icon>
                    Voltar
                </v-btn>
            </div>

        </div>
    </div>
    </div>
</template>

<script>
import navbar from '../../components/navbar/navbar.vue'

export default {
    data() {
        return {

            products: [
                {
                    id: 1,
                    name: 'Monitor Gamer Asus TUF',
                    price: 1699.99,
                    quantity: 1,
                },
                {
                    id: 2,
                    name: 'Placa de Video RX 6750 XT MECH',
                    price: 1939.99,
                    quantity: 1,
                },
            ],
        };
    },

    components: {
        navbar,
    },

    computed: {
        totalPrice() {
            return this.products.reduce(
                (total, product) => total + product.price * product.quantity,
                0
            ).toFixed(2);
        },
        userInfo() {
            return this.$store.state.user;
        },
    },
    inject: ['handleGoNext', 'handleGoBack'],

    methods: {

        increaseQuantity(product) {
            product.quantity++;
        },
        decreaseQuantity(product) {
            if (product.quantity > 1) {
                product.quantity--;
            }
        },
    },
};
</script>
