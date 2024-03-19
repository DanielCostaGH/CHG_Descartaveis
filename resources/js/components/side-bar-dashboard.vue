<template>
    <!-- Barra lateral -->
    <aside class="bg-white text-gray-700 w-1/5 min-h-screen p-5">
        <div class="flex w-full items-center justify-center">
            <img class="mb-8 w-4/6" :src="logo_light" alt="">
        </div>

        <ul class="text-xl">
            <li class="mb-4">
                <a href="/dashboard"
                    class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
                    <img class="pr-6" :src="dashboard" alt="">
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="mb-4">
                <a href="/dashboard/products"
                    class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
                    <img class="pr-6" :src="product" alt="">
                    <span>Produtos</span>
                </a>
            </li>

            <li class="mb-4">
                <a href="/dashboard/categories"
                    class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#2A4178" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                    </svg>
                    <span>Categorias</span>
                </a>
            </li>

           

            <li class="mb-4">
                <a href="/dashboard/appearence"
                    class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
                    <img class="pr-6" :src="appearance" alt="">
                    <span>Aparência</span>
                </a>
            </li>

            <li class="mb-4">
                <a href="/dashboard/orders"
                    class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">

                    <img class="pr-6" :src="order_pending" alt="">
                    <span>Pedidos Pendentes</span>
                </a>
            </li>

            <li class="mb-4">
                <a href="/dashboard/shipped"
                    class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
                    <img class="pr-6" :src="product_sent" alt="">
                    <span>Pedidos Enviados</span>
                </a>
            </li>

            <!-- <li class="mb-4">
                <a
                    class="flex items-center text-[#99A8CB] p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
                    <img class="pr-6" :src="payment" alt="">
                    <span>Pagamentos</span>
                </a>
            </li> -->

            <li class="mb-4">
                <a href="/dashboard/config"
                    class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
                    <img class="pr-6" :src="config" alt="">
                    <span>Configurações</span>
                </a>
            </li>

        </ul>
    </aside>
</template>


<script>
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
};
</script>
