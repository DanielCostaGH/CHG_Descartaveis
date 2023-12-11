<template>
    <navbar/>
    <div class="container mx-auto my-5">
    <div class="flex h-[60vh]">
        <div class="w-4/6">
            <div class="p-4 flex shadow-lg rounded-lg mx-5 my-10">
                <div>
                    <h1 class="">Endereço Principal</h1>
                    <v-label>{{ address.street }}, {{ address.number }}</v-label><br>
                    <v-label>{{ address.zip }} - {{ address.city }}</v-label>
                </div>
                <div class="w-full flex justify-end gap-2 items-center">
                    <v-btn text color="primary">EDITAR</v-btn>
                    <v-btn text color="primary">SELECIONAR OUTRO</v-btn>
                </div>
            </div>

            <div class="mx-5 my-10 shadow-lg rounded-lg p-5">

                <div v-if="empty">
                    <v-label class="text-h6">Carrinho vazio. Adicione produtos!</v-label>
                </div>
                <div v-for="product in products" :key="product.id"
                    class="p-5 my-5 shadow-lg rounded-lg flex items-center justify-between">
                    <div>
                        <h1>{{ product.name }}</h1>
                        <v-label class="my-1">preço: {{ product.price }}</v-label>


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

                    <div>
                        <button @click="removeProduct(product)">
                            <v-icon size="25" class="hover hover:bg-indigo">mdi-delete-outline</v-icon>
                        </button>
                    </div>


                </div>
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
                <v-btn  @click="goNext" color="#2B9D44" block large dark class="my-5 text-h6" rounded="lg"
                    style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
                    <v-icon left class="mr-3 text-h4">
                        mdi-cash
                    </v-icon>
                    Ir para pagamento
                </v-btn>

                <v-btn href="/" color="primary" block large dark class="my-5 text-h6" rounded="lg"
                    style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
                    <v-icon left class="mr-3 text-h4">
                        mdi-arrow-left
                    </v-icon>
                    Continuar comprando
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
            address: {
                street: 'Rua Geraldo Pereira da Silva',
                number: '67, Casa Laranja (2 Andar)',
                additionalInfo: '',
                zip: '30810423',
                city: 'Belo Horizonte, MG'
            },
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
            empty: false,
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
    },
    methods: {
        increaseQuantity(product) {
            product.quantity++;
        },
        decreaseQuantity(product) {
            if (product.quantity > 1) {
                product.quantity--;
            }
        },
        removeProduct(productToRemove) {
            this.products = this.products.filter(
                (product) => product.id !== productToRemove.id
            );
            this.emptyCart()
        },

        emptyCart() {
            if (this.products.length == 0) {
                this.empty = true;
            }

        },

        goNext() {
            this.$emit('go-next');
        },


    },

    mounted(){
        this.emptyCart()
    }


};
</script>
