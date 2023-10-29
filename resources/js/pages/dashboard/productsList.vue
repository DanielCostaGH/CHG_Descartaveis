<template>
    <div class="flex">
        <!-- Barra lateral -->
        <sidebar/>

        <!-- Conteúdo principal -->
        <main class="w-4/5 p-6 bg-gray-100">
            <!-- Header -->
            <header>
                <painel/>
            </header>

            <div>
                <dashboard_filters />
                <!-- Lista de Produtos -->
                <div class="flex flex-wrap">
                    <!-- Loop through products -->
                    <div v-for="product in products" :key="product.id" class="w-1/4 p-4">
                        <a :href="'/dashboard/products/edit/' + product.id" class="bg-white rounded-lg shadow-md p-4 transition-transform hover:scale-105 hover:shadow-lg relative">
                            <div class="h-[30vh] w-[30vh]">
                                <img class="h-5/6 text-center bg-gray-100" :src="product.image" :alt="product.name">
                                <div class="text-center py-5">
                                    <!-- Exibe o nome do produto -->
                                    <span>{{ product.name }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </main>
    </div>
</template>
  
<script>
import dashboard_filters from '../../components/dashboard-filters.vue'
import sidebar from '../../components/side-bar-dashboard.vue'
import painel from '../../components/painel-bar.vue'

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
        };
    },

    components: {
        dashboard_filters,
        sidebar,
        painel,
    },

    props: {
        products: Array, // Espera um array de produtos
    },
};
</script>
