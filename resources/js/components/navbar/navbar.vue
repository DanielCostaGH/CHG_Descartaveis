<template>
    <!-- MODELO DESKTOP -->

    <nav class="bg-white">
        <div class="container mx-auto hidden md:flex flex-col justify-between md:flex-row items-center">
            <a href="/">
                <img class="md:h-[160px]" :src="logo_light" alt="Logo">
            </a>

            <!-- Barra de pesquisa -->

            <div class="w-5/6 md:w-3/6 px-4 mt-4 md:mt-0 relative">
                <img class="absolute left-4 top-1/2 transform -translate-y-1/2 px-4" :src="search" alt="icon">
                <input type="text" v-model="searchQuery" @input="fetchSuggestions"
                    class="rounded-lg bg-[#F3F9FB] shadow-md p-4 pl-12 w-full focus:border-2 focus:outline-none focus:border-gray-400 text-lg"
                    placeholder="Pesquise o que procura" />

                <div v-if="suggestions.length > 0" class="absolute z-10 w-5/6 bg-white border-b mt-1 rounded-lg">
                    <ul>
                        <li v-for="suggestion in suggestions" :key="suggestion.id"
                            class="p-4 hover:bg-gray-100 cursor-pointer" @click="redirectToProduct(suggestion.id)">
                            {{ suggestion.name }}
                        </li>

                    </ul>
                </div>
            </div>

            <div class="md:space-x-4 mt-4 md:mt-0 hidden md:flex">
                <div class="flex items-center hover:underline">

                    <img class="mr-2" :src="user" alt="">
                    <a href="/user/login">Login/Cadastro</a>
                </div>
                <div class="flex items-center hover:underline">
                    <v-icon class="mr-2">
                        <img :src="cart" alt="">
                    </v-icon>
                    <a href="#">Carrinho</a>
                </div>
            </div>

        </div>


        <!-- MODELO MOBILE -->

        <div class="md:hidden ">


            <div class="md:hidden flex justify-between md:flex-row items-center">
                <a href="/">
                    <img class="" :src="logo_light" alt="Logo">
                </a>

                <button @click="toggleMenu" class="md:hidden text-gray-600 mx-5 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>


            </div>
            <div class="w-5/6 mx-auto px-4 my-4 relative">
                <img class="absolute left-4 top-1/2 transform -translate-y-1/2 px-4" :src="search" alt="icon">
                <input type="text"
                    class="rounded-lg bg-[#F3F9FB] shadow-md p-4 pl-12 w-full focus:border-2 focus:outline-none focus:border-gray-400 text-lg"
                    placeholder="Pesquise o que procura" />
            </div>

            <div :class="{ 'mobile-menu': menuOpen }" class="relative duration-300 border-white md:hidden">
                <ul class="text-gray-600 py-2">
                    <li class="my-2 flex items-center justify-center hover:underline">
                        <img class="mr-2" :src="user" alt="">
                        <a href="#">Login/Cadastro</a>
                    </li>
                    <li class="my-4 flex items-center justify-center hover:underline">
                        <img class="mr-2" :src="cart" alt="">
                        <a href="#">Carrinho</a>
                    </li>
                </ul>
            </div>




        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            searchQuery: '',
            suggestions: [],
            logo_light: '/images/logo_light.svg',
            search: '/images/search.svg',
            user: '/images/user.svg',
            cart: '/images/buy.svg',
            menuOpen: true,
        };
    },


    methods: {
        toggleMenu() {
            this.menuOpen = !this.menuOpen;
        },

        fetchSuggestions() {
            if (this.searchQuery.length > 1) {
                axios.get(`/api/products/search?query=${encodeURIComponent(this.searchQuery)}`)
                    .then(response => {
                        this.suggestions = response.data;
                    })
                    .catch(error => {
                        console.error('Erro ao buscar sugestões:', error);
                    });
            } else {
                this.suggestions = [];
            }
        },

        redirectToProduct(productId) {
        window.location.href = `/products/${productId}`;
    },

    }

}
</script>


<style>
.mobile-menu {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
}
</style>
