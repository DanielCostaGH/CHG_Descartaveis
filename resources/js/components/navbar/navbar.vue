<script>

export default {
  data() {
    return {
      logo_light: '/images/logo_light.svg',
      search: '/images/search.svg',
      user: '/images/user.svg',
      cart: '/images/buy.svg',
    };
  },
};
</script>

<template>
  <nav class="bg-white">
    <div class="container mx-auto flex flex-col justify-between md:flex-row items-center 1/6">
      <!-- Logo -->
      <div>
        <img class="h-[160px]" :src="logo_light" alt="Logo">
      </div>

      <!-- Barra de pesquisa -->
      <div class="w-3/6 px-4 mt-4 md:mt-0 relative">
          <img class="absolute left-4 top-1/2 transform -translate-y-1/2 px-4" :src="search" alt="icon">
        <input type="text"
          class="rounded-lg bg-[#F3F9FB] shadow-md p-4 pl-12 w-full focus:border-2 focus:outline-none focus:border-gray-400 text-lg"
          placeholder="Pesquise o que procura" />
      </div>

      <!-- Links -->
      <div class="md:space-x-4 mt-4 md:mt-0 flex 2/6">
        <div class="flex items-center hover:underline">
            <img class="mr-2" :src="user" alt="">
          <a href="#">Login/Cadastro</a>
        </div>
        <div class="flex items-center hover:underline">
          <img class="mr-2" :src="cart" alt="">
          <a href="#">Carrinho</a>
        </div>
      </div>
    </div>
  </nav>
</template>

  