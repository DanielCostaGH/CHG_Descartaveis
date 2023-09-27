<template>
    <!-- Barra lateral -->
    <aside class="bg-white text-gray-700 w-1/5 min-h-screen p-5">
      <div class="flex w-full items-center justify-center">
        <img class="mb-8 w-4/6" :src="logo_light" alt="">
      </div>

      <ul class="text-xl">
        <li class="mb-4 mx-5">
          <a href="/dashboard" class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
            <img class="pr-6" :src="dashboard" alt="">
            <span>Dashboard</span>
          </a>
        </li>

        <li class="mb-4 mx-5">
          <a href="/dashboard/products" class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
            <img class="pr-6" :src="product" alt="">
            <span>Produtos</span>
          </a>
        </li>

        <li class="mb-4 mx-5">
          <a href="/dashboard/appearence" class="flex items-center p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
            <img class="pr-6" :src="appearance" alt="">
            <span>Aparência</span>
          </a>
        </li>

        <li class="mb-4 mx-5">
          <a class="flex items-center text-[#99A8CB] p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
            <img class="pr-6" :src="order_pending" alt="">
            <span>Pedidos pendentes</span>
          </a>
        </li>

        <li class="mb-4 mx-5">
          <a  class="flex items-center text-[#99A8CB] p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
            <img class="pr-6" :src="product_sent" alt="">
            <span>Pedidos Enviados</span>
          </a>
        </li>

        <li class="mb-4 mx-5">
          <a  class="flex items-center text-[#99A8CB] p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
            <img class="pr-6" :src="payment" alt="">
            <span>Pagamentos</span>
          </a>
        </li>

        <li class="mb-4 mx-5">
          <a  class="flex items-center text-[#99A8CB] p-5 rounded-lg hover:bg-[#F3F4F5] hover:shadow-lg active:bg-gray-200">
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