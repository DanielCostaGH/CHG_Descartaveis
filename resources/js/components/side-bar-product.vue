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
                        <div>
                            <div class="rounded-circle shadow-lg"
                                :style="{ backgroundColor: color.value, width: '60px', height: '60px' }"
                                @click="selectedColor = color.name"></div>
                        </div>
                    </v-col>
                </v-row>
            </div>

            <div>
                <v-label>Variações</v-label>
                <v-row>
                    <v-col cols="12">
                        <v-select :items="productVariations" label="Veja as variações"></v-select>
                    </v-col>
                </v-row>

                <div>
                        <v-btn color="#2B9D44" block large dark class="my-5 text-h6 font-weight-bold" rounded="lg" style="padding-top: 2rem; padding-bottom: 2rem;">
                            <v-icon left class="mr-3 text-h4" >
                                mdi-whatsapp
                            </v-icon>
                            Comprar
                        </v-btn>
                </div>



            </div>
        </div>


    </div>
</template>

<script>
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
        }

    },
    props: {
        product: Object,
    },
    computed: {
        productVariations() {
            return this.product.variation.split(';').filter(variation => variation.trim() !== '');
        },
    },
}
</script>



<style>
.color-selected {
    border: 2px solid black;
    box-shadow: 2px black;
}
</style>
