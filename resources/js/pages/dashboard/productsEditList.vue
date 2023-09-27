<template>
    <div class="flex">
        <!-- Barra lateral -->
        <sidebar/>

        <!-- Conteúdo principal -->
        <main class="w-4/5 p-6 bg-[#F3F4F5]">
            <!-- Header -->
            <header class="bg-white shadow-md p-4 mb-6 rounded-lg">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold">Painel de Controle</h2>
                    <div class="flex space-x-4">
                        <a href="/admin/profile" class="text-gray-600 hover:text-blue-500 ease-in-out">Perfil</a>
                        <a href="#" class="text-gray-600 hover:text-blue-500 ease-in-out">Sair</a>
                    </div>
                </div>
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

    },


};
</script>
  