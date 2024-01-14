<template>
     <!-- Resumo -->
     <div class="w-2/6 mx-5 my-10 rounded-lg shadow-lg">

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
    <v-btn :href="userInfo ? `/cart/payment/${userInfo.id}` : '#'" color="#2B9D44" block large dark
        class="my-5 text-h6" rounded="lg" style="padding-top: 1.6rem; padding-bottom: 1.6rem;">
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

<div>
    <v-label>Calcular frete</v-label>
    <v-input></v-input>
</div>
<div>
    <v-list>
        <v-list-item v-for="(frete, index) in freteList" :key="index"></v-list-item>
    </v-list>
</div>

</div>
</template>


<script>
import axios from 'axios';

export default{
    data(){
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

    },

    methods: {
        getTotalPrice(){
            axios.get('/api/get_total_price/')
            .then(response => this.totalPrice = response.data)
        }
    },

    mounted(){
        this.getTotalPrice()
    }
}
</script>
