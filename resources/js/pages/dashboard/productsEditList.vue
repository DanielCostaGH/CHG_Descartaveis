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
                <filters />
                <!-- Cards de Produto -->
                <div class="flex flex-wrap">
                    <!-- Card -->
                    <a href="/dashboard/products/1" class="bg-white rounded-lg shadow-md p-4 transition-transform hover:scale-105 hover:shadow-lg relative">
                        <div class="h-[30vh] w-[30vh]">
                            <img class="h-5/6 text-center bg-gray-100" src="/images/teste." alt="imagem do produto">
                            <div class="text-center py-5">
                                <span>Nome do produto</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

        </main>
    </div>
</template>
  
<script>
import filters from '../../components/filters.vue'
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
        filters,
        sidebar,
        painel,
    },


};
</script>
  