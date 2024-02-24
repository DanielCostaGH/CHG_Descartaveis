<template>
    <navbar />
    <div id="main" class="container mx-auto">
        <filters @filter-applied="handleFilterApplied" />
        <cards :products="products" />
        <v-pagination v-model="page" :length="totalPages" rounded="circle"></v-pagination>
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
            products: [],
            page: 1,
            totalPages: 0,
        };
    },
    watch: {
        '$route'(to, from) {
            if (to.path === '/products') {
                this.fetchFilteredProducts();
            }
        },
        page(newVal, oldVal) {
            if (newVal !== oldVal) this.fetchProducts(); // Recarregar os dados quando a página mudar
        }
    },

    methods: {
        fetchFilteredProducts() {
            const filters = { ...this.$route.query };

            if (filters.query) {
                filters.productName = filters.query;
                delete filters.query;
            }
            if (this.$route.query.categoryId) {
                filters.categoryId = this.$route.query.categoryId;
            }

            this.fetchProducts(filters);
        },

        fetchProducts(filters = {}) {
            axios.get(`/api/products?page=${this.page}`, { params: filters })
                .then(response => {
                    this.products = response.data.data;
                    this.totalPages = response.data.last_page;
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
        this.fetchFilteredProducts();
    },

    components: {
        navbar,
        filters,
        cards,
        foot,
    },
};
</script>
