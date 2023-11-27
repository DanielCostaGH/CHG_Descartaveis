<template>
    <navbar />
    <div id="main" class="container mx-auto">
        <filters @filter-applied="handleFilterApplied" />
        <cards :products="products" />
    </div>
    <foot />
</template>

<script>
import navbar from '../components/navbar/navbar.vue';
import filters from '../components/filters.vue';
import cards from '../components/card-products.vue';
import foot from '../components/footer.vue';
import axios from 'axios';

export default {
    data() {
        return {
            products: []
        };
    },
    methods: {
        fetchProducts(filters = {}) {
            axios.get('/api/products', { params: filters })
                .then(response => {
                    this.products = response.data;
                })
                .catch(error => {
                    console.error('Erro ao buscar produtos:', error);
                });
        },

        handleFilterApplied(filters) {
            this.fetchProducts(filters);
        },
    },
    mounted() {
        this.fetchProducts();
    },
    components: {
        navbar,
        filters,
        cards,
        foot,
    },
};
</script>
