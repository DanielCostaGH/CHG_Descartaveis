<template>
    <div class="flex">
        <!-- Barra lateral -->
        <aside class="bg-white text-gray-700 w-1/5 min-h-screen p-5">
            <div class="flex w-full items-center justify-center">
                <img class="mb-8 w-4/6" :src="logo_light" alt="">
            </div>

            <ul class="text-xl">
                <li class="mb-4 mx-5">
                    <a href="/dashboard"
                        class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:border-purple-500 hover:shadow-lg">
                        <img class="pr-6" :src="dashboard" alt="">
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="mb-4 mx-5">
                    <a href="/dashboard/products"
                        class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:border-purple-500 hover:shadow-lg">
                        <img class="pr-6" :src="product" alt="">
                        <span>Produtos</span>
                    </a>
                </li>

                <li class="mb-4 mx-5">
                    <a href="/dashboard/appearence"
                        class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:border-purple-500 hover:shadow-lg">
                        <img class="pr-6" :src="appearance" alt="">
                        <span>Aparência</span>
                    </a>
                </li>

                <li class="mb-4 mx-5">
                    <a href="#"
                        class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:border-purple-500 hover:shadow-lg">
                        <img class="pr-6" :src="order_pending" alt="">
                        <span>Pedidos pendentes</span>
                    </a>
                </li>

                <li class="mb-4 mx-5">
                    <a href="#"
                        class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:border-purple-500 hover:shadow-lg">
                        <img class="pr-6" :src="product_sent" alt="">
                        <span>Pedidos Enviados</span>
                    </a>
                </li>

                <li class="mb-4 mx-5">
                    <a href="#"
                        class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:border-purple-500 hover:shadow-lg">
                        <img class="pr-6" :src="payment" alt="">
                        <span>Pagamentos</span>
                    </a>
                </li>

                <li class="mb-4 mx-5">
                    <a href="#"
                        class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:border-purple-500 hover:shadow-lg">
                        <img class="pr-6" :src="config" alt="">
                        <span>Configurações</span>
                    </a>
                </li>

            </ul>
        </aside>

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

            <main>
                <div>
                    <span>appearence</span>
                </div>
            </main>

            

        </main>
    </div>
</template>
  
<script>
import filters from '../../components/filters.vue'

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

    },


};
</script>
  