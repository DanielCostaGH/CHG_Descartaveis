<template>
    <div class="flex">
        <sidebar />

        <main class="w-4/5 p-6 bg-gray-100">
            <header>
                <painel />
            </header>

            <div>
                <dashboard_filters />

                <section class="bg-white h-[75vh] overflow-y-scroll">
                    <div>
                        <div class="bg-white p-4 shadow-md rounded-lg">
                            <h2 class="text-xl font-medium">Lista de Produtos</h2>
                            <div class="flex flex-wrap">
                                <div v-for="(product, index) in products" :key="index" class="p-4">
                                    <div class="">
                                        <div class="bg-white border shadow-md rounded-lg p-4 w-[40vh] h-[45vh]">
                                            <div class="overflow-x-hidden">
                                                <h3 class="text-lg font-medium mt-2">{{ product.name }}</h3>
                                            </div>

                                            <div class="h-4/6 flex justify-center items-center">
                                                <img class="object-contain h-full" :src="getFirstImage(product)" alt="Product Image">
                                            </div>

                                            <div class="mt-4 h-2/6 pb-5 flex justify-around items-center">

                                                <a class="flex items-center border-2 border-blue-600 text-blue-600 hover hover:text-white hover:bg-blue-600 py-3 px-4 rounded"
                                                    :href="'/dashboard/products/edit/' + product.id">

                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                                    </svg>

                                                    Editar
                                                </a>

                                                <a @click="confirmDelete(product.id)" class="flex items-center border-2 cursor-pointer border-red-600 text-red-600 hover hover:text-white hover:bg-red-600 py-3 px-4 rounded ml-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-3">
                                                    <!-- Seu ícone 'Excluir' -->
                                                    </svg>
                                                    Excluir produto
                                                </a>
                                            </div>

                                            <div v-if="products.length === 0" class="text-center py-10">
                                                Nenhum produto encontrado.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>
</template>

<script>
import dashboard_filters from '../../components/dashboard-filters.vue'
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'
import axios from 'axios';

export default {
    data() {
        return {
            logo_light: '/images/logo_light.svg',
            dashboard: '/images/dashboard_icon.svg',
            product: '/images/product_icon.svg',
            appearance: '/images/appearance_icon.svg',
            product_sent: '/images/car_icon.svg',
            order_pending: '/images/shopCart_icon.svg',
            payment: '/images/pay_icon.svg',
            config: '/images/config_icon.svg',
            products: [],
        };
    },

    components: {
        dashboard_filters,
        sidebar,
        painel,
    },

    mounted() {
        this.fetchProducts();
    },

    methods: {
        async fetchProducts() {
            try {
                const response = await axios.get('/api/products');
                this.products = response.data;
            } catch (error) {
                console.error('Erro ao buscar produtos:', error);
                alert("Houve um erro ao carregar os produtos. Por favor, tente novamente.");
            }
        },
        
        async confirmDelete(productId) {
            if (confirm('Tem certeza que deseja excluir este produto?')) {
                await this.deleteProduct(productId);
            }
        },

        async deleteProduct(productId) {
            try {
                await axios.delete(`/dashboard/delete/${productId}`);
                // Recarregar a lista de produtos após a exclusão
                this.fetchProducts();
            } catch (error) {
                console.error('Erro ao excluir produto:', error);
                alert('Houve um erro ao excluir o produto. Por favor, tente novamente.');
            }
        },

        getFirstImage(product) {
            if (!product.images) return '/images/empty.png';

            const imageList = product.images.split(';');
            if (imageList[0].startsWith('/images/')) {
                return imageList[0];
            }

            return `/images/products/${product.id}/${imageList[0]}`;
        },

    },
};
</script>
