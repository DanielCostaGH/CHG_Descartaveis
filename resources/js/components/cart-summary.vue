<template>
    <!-- Resumo -->
    <div class="w-full md:w-full lg:w-2/6 sm:min-h-[80vh] sm:mx-5 my-10 rounded-lg shadow-lg">

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

        <div class="sm:w-5/6 lg:w-5/6  md:w-3/6 w-full mx-auto px-5">
            <v-btn @click="onButton1Click" color="#2B9D44" block large dark class="my-5 text-h6" rounded="lg"
                style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
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

        <div v-if="cartStep !== 'confirmation'" class="lg:w-5/6 md:w-3/6 mx-auto px-5 my-5">
            <v-label>Calcular frete</v-label>
            <v-text-field v-model="destinationPostalCode" placeholder="Digite o CEP de destino"></v-text-field>
            <v-btn @click="calculateFrete">Calcular</v-btn>
        </div>

        <div v-if="freteList.length > 0" class="my-10">
            <v-list>
                <v-list-item v-for="(frete, index) in freteList" :key="index">
                    {{ frete.service_name }} - R$ {{ frete.price }}
                </v-list-item>
            </v-list>
        </div>

    </div>


    <!-- Endereço obrigatorio -->
    <v-dialog v-model="showDialogAddress">
        <v-card class="mx-auto">
            <v-card-title class="headline">Atenção</v-card-title>
            <v-card-text>
                É necessário preencher um endereço para continuar com a compra.
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green darken-1" text @click="showDialogAddress = false">Fechar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>

    <!-- Metodo de pagamento obrigatorio -->
    <v-dialog v-model="showDialogPayment">
        <v-card class="mx-auto">
            <v-card-title class="headline">Atenção</v-card-title>
            <v-card-text>
                É necessário preencher um metodo de pagamento para continuar com a compra.
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="green darken-1" text @click="showDialogPayment = false">Fechar</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {
            destinationPostalCode: '',
            freteList: [],
            showDialogAddress: false,
            showDialogPayment: false,
        }
    },

    props: {
        totalPrice: {
            type: String,
            required: true
        },

        products: Array,
        selectedMainAddress: Object,
        selectedPaymentMethod: Object,
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

        button2Text() {
            return (this.cartStep === 'payment' || this.cartStep === 'confirmation')
                ? 'Voltar'
                : 'Continuar comprando';
        },

        button2Href() {
            const id = this.userInfo ? this.userInfo.id : '';
            switch (this.cartStep) {
                case 'confirmation':
                    return `/cart/payment/${id}`;
                case 'index':
                    return '/';
                default:
                    return `/cart/${id}`;
            }
        },


    },

    methods: {

        onButton1Click() {

            if (!this.selectedMainAddress) {
                this.showDialogAddress = true;
                return; // Impede a continuação do método
            }
            // Verificar se o método de pagamento está selecionado na etapa de pagamento
            if (this.cartStep === 'payment' && !this.selectedPaymentMethod) {
                this.showDialogPayment = true;
                return;
            }

            let nextUrl = '';
            const id = this.userInfo ? this.userInfo.id : '';
            switch (this.cartStep) {
                case 'payment':
                    this.$emit('continueToConfirmation');
                    nextUrl = `/cart/confirmation/${id}`;
                    break;
                case 'confirmation':
                    nextUrl = `/cart/buy/${id}`;
                    break;
                default:
                    nextUrl = `/cart/payment/${id}`;
                    break;
            }
            window.location.href = nextUrl;

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
