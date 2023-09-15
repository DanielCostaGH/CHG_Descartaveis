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
        <v-icon class="absolute left-4 top-1/2 transform -translate-y-1/2 px-4">
          <img :src="search" alt="icon">
        </v-icon>
        <input type="text"
          class="rounded-lg bg-[#F3F9FB] shadow-md p-4 pl-12 w-full focus:border-2 focus:outline-none focus:border-gray-400 text-lg"
          placeholder="Pesquise o que procura" />
      </div>

      <!-- Links -->
      <div class="md:space-x-4 mt-4 md:mt-0 flex 2/6">
        <div class="flex items-center hover:underline">
          <v-icon class="mr-2">
            <img :src="user" alt="">
          </v-icon>
          <a href="#">Login/Cadastro</a>
        </div>
        <div class="flex items-center hover:underline">
          <v-icon class="mr-2">
            <img :src="cart" alt="">
          </v-icon>
          <a href="#">Carrinho</a>
        </div>
      </div>
    </div>
  </nav>
</template>

  