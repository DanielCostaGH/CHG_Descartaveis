<template>
    <!-- Resumo -->
    <div class="w-2/6 min-h-[80vh] mx-5 my-10 rounded-lg shadow-lg">

        <div>

        </div>
        <div class="p-7 text-h5 font-weight-bold flex items-center">
            <v-icon color="#2B9D44">mdi-file-search</v-icon>
            <span class="text-gray-600 mx-4">Resumo</span>
        </div>

        <div class="p-7">
            <span class="font-weight-bold">Valor dos Produtos: <span class="p-2 text-white rounded bg-indigo">R$ {{
                totalPrice }}</span></span>
            <hr class="my-5">
            <div class="py-5">
                <v-label class="font-weight-bold">Frete: <span class="p-2">R$ 00,00</span></v-label> <br>
            </div>
            <span class="font-weight-bold">Valor com frete: <span class="p-2 text-white rounded bg-warning">R$ {{
                totalPrice
            }}</span> </span>
        </div>

        <div class="w-5/6 mx-auto px-5">
            <v-btn :href="button1Href" @click="onButton1Click" color="#2B9D44" block large dark class="my-5 text-h6"
                rounded="lg" style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
                <v-icon left class="mr-3 text-h4">
                    mdi-cash
                </v-icon>
                {{ button1Text }}
            </v-btn>

            <v-btn :href="button2Href" color="indigo" block large dark class="my-5 text-h6" rounded="lg"
                style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
                <v-icon left class="mr-3 text-h4">
                    mdi-arrow-left
                </v-icon>
                {{ button2Text }}
            </v-btn>
        </div>

        <div v-if="cartStep !== 'confirmation'" class="w-5/6 mx-auto px-5">
            <v-label>Calcular frete</v-label>
            <v-text-field v-model="destinationPostalCode" placeholder="Digite o CEP de destino"></v-text-field>
            <v-btn @click="calculateFrete">Calcular</v-btn>
        </div>

        <div v-if="freteList.length > 0">
            <v-list>
                <v-list-item v-for="(frete, index) in freteList" :key="index">
                    {{ frete.service_name }} - R$ {{ frete.price }}
                </v-list-item>
            </v-list>
        </div>

    </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            destinationPostalCode: '',
            freteList: [],
        }
    },

    props: {
        totalPrice: {
            type: String,
            required: true
        },

        products: Array,
    },

    computed: {

        userInfo() {
            return this.$store.state.user;
        },

        cartStep() {
            const path = this.$route.path;
            if (path.includes('/payment/')) {
                return 'payment';
            } else if (path.includes('/confirmation/')) {
                return 'confirmation';
            } else {
                return 'index';
            }
        },

        button1Text() {
            switch (this.cartStep) {
                case 'payment':
                    return 'Continuar';
                case 'confirmation':
                    return 'Finalizar compra';
                default:
                    return 'Ir para pagamento';
            }
        },

        button1Href() {
            const id = this.userInfo ? this.userInfo.id : '';
            switch (this.cartStep) {
                case 'payment':
                    return `/cart/confirmation/${id}`;
                case 'confirmation':
                    return `/cart/buy/${id}`;
                default:
                    return `/cart/payment/${id}`;
            }
        },

        button2Text() {
            return this.cartStep === 'index' ? 'Continuar comprando' : 'Voltar';
        },

        button2Href() {
            const id = this.userInfo ? this.userInfo.id : '';
            return this.cartStep === 'index' ? '/' : `/cart/${id}`;
        },

    },

    methods: {

        onButton1Click() {
            if (this.cartStep === 'payment') {
                this.$emit('continueToConfirmation');
                this.$router.push(this.button1Href);
            } else {
                this.$router.push(this.button1Href);
            }
        },

        calculateFrete() {

            const productDetails = this.products.map(product => ({
                id: product.id,
                width: product.width,
                height: product.height,
                length: product.length,
                weight: product.weight,
                insurance_value: product.insurance_value,
                quantity: product.quantity
            }));

             axios.post('/api/calculate-frete', {
                to: { postal_code: this.destinationPostalCode },
                products: productDetails
            })
            .then(response => {
                this.freteList = response.data;
            })
            .catch(error => {
                console.error('Erro ao calcular o frete:', error);
            });
        },


    },
}
</script>
