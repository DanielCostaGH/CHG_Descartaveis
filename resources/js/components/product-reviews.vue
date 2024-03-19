<template>
    <div class="py-10">
        <div class=" mx-auto">
            <!-- Avaliação Média -->
            <div class="text-center mb-6">
                <h2 class="text-2xl font-semibold">Avaliação Média</h2>
                <div class="text-4xl font-bold">{{ parseFloat(averageRating) }}</div>
                <div class="flex items-center justify-center space-x-1">
                    <v-rating v-model="averageRating" size="35" dense color="amber" half-increments></v-rating>
                </div>
            </div>

            <!-- Avaliações dos Clientes -->
            <h2 class="text-2xl font-semibold mb-4">Avaliações dos Clientes</h2>
            <div class="max-h-[60vh] overflow-y-scroll">

                <div v-for="review in reviews" :key="review.id" class="mb-4 p-4 bg-white rounded-lg shadow-md ">
                    <div class="text-xl font-semibold">{{ review.title }}</div>
                    <div class="text-gray-500">Por: {{ review.user_name }}</div>
                    <v-label class="mt-2">Mensagem: {{ review.comment }}</v-label>
                    <div class="mt-2 flex ">
                        <v-label>Avaliação:</v-label>
                        <v-rating v-model="review.rating" size="25" dense color="amber" half-increments class=""></v-rating>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            averageRating: 0,
            reviews: [],
        };
    },

    props: {
        product: Object,
    },

    mounted() {
        this.reviewedProduct()
    },

    formattedAverageRating() {
        return parseFloat(this.averageRating).toFixed(2);
    },

    methods: {

        reviewedProduct() {
            axios.get('/api/get-product-reviews', {
                params: {
                    productId: this.product.id
                }
            })
            .then(response => {
                this.reviews = response.data.reviews; 
                this.averageRating = parseFloat(response.data.averageRating) || 0;
            })
            .catch(error => {
                console.error('Erro ao buscar avaliações:', error);
            });
        }

    },
};
</script>
