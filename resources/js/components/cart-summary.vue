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
            <span class="font-weight-bold">Valor dos Produtos: <span class="p-2 text-white rounded bg-primary">R$ {{
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

            <v-btn :href="button2Href" color="primary" block large dark class="my-5 text-h6" rounded="lg"
                style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
                <v-icon left class="mr-3 text-h4">
                    mdi-arrow-left
                </v-icon>
                {{ button2Text }}
            </v-btn>
        </div>

        <div v-if="cartStep !== 'confirmation'" class="w-5/6 mx-auto px-5">
            <v-label>Calcular frete</v-label>
            <v-text-field></v-text-field>
        </div>
        <div v-if="cartStep !== 'confirmation'">
            <v-list>
                <v-list-item v-for="(frete, index) in freteList" :key="index"></v-list-item>
            </v-list>
        </div>

    </div>
</template>


<script>
import axios from 'axios';

export default {
    data() {
        return {

        }
    },

    props: {
        totalPrice: {
            type: String,
            required: true
        }
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
    },
}
</script>
