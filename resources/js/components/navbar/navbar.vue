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
                <input type="text" v-model="searchQuery" @input="fetchSuggestions" @keyup.enter="searchProducts"
                    class="rounded-lg bg-[#F3F9FB] p-4 pl-12 w-full shadow focus:shadow-lg focus:outline-none focus:border-gray-400 text-lg"
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
                    <a v-if="userInfo" href="/user/info">Minha conta</a>
                    <a v-else href="/user/login">Login/Cadastro</a>
                </div>
                <div class="flex items-center hover:underline">
                    <v-icon class="mr-2">
                        <img :src="cart" alt="">
                    </v-icon>
                    <a :href="cartUrl">Carrinho</a>
                </div>
            </div>

        </div>


        <!-- MODELO MOBILE -->

        <div class="md:hidden ">


            <div class="md:hidden flex justify-between md:flex-row items-center">
                <a href="/">
                    <img class="" :src="logo_light" alt="Logo">
                </a>

                <v-btn  @click.stop="drawer = !drawer" class="md:hidden text-gray-600 mx-5 duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </v-btn>
               
            </div>
            <div class="mx-auto px-6 my-4 relative flex">
                <input type="text" v-model="searchQuery" @keyup.enter="searchProducts"
                    class="rounded-lg bg-[#F3F9FB] p-4 pl-12 w-full shadow focus:shadow-lg focus:outline-none focus:border-gray-400 text-lg"
                    placeholder="Pesquise o que procura" />

                <button @click="searchProducts" class="relative p-2">
                    <img class="h-6 w-6" :src="search" alt="Ícone de pesquisa">
                </button>
            </div>

            <div :class="{ 'mobile-menu': menuOpen }" class="relative duration-300 border-white md:hidden">
                <ul class="text-gray-600 py-2">
                    <li class="my-2 flex items-center justify-center hover:underline">
                        <img class="mr-2" :src="user" alt="">
                        <a v-if="userInfo" :href="`/user/${userInfo.id}`">Minha conta</a>
                        <a v-else href="/user/login">Login/Cadastro</a>
                    </li>
                    <li class="my-4 flex items-center justify-center hover:underline">
                        <img class="mr-2" :src="cart" alt="">
                        <a :href="cartUrl">Carrinho</a>
                    </li>
                </ul>
            </div>

            <v-layout>
                <v-navigation-drawer color="#212844" rounded v-model="drawer" temporary location="right">
                    <sidebar/>
                </v-navigation-drawer>
            </v-layout>
           


        </div>
    </nav>
</template>

<script>
import sidebar from './sidebar.vue';

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
            userData: [],
            drawer: null,
        };
    },

    components: {
        sidebar,
    },

    computed: {
        userInfo() {
            return this.$store.state.user;
        },

        cartUrl() {
            if (this.userInfo) {
                return `/cart/${this.userData.id}`;
            } else {
                return '/local/cart';
            }
        },
    },

    watch: {
        '$store.state.user': {
            handler(newValue, oldValue) {
                this.setUserData();
            },
            deep: true,
        },
    },

    methods: {
        setUserData() {
            this.userData = this.userInfo;
        },
        // toggleMenu() {
        //     this.menuOpen = !this.menuOpen;
        // },
        toggleSidebar() {
            this.sidebar = !this.sidebar;
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

        searchProducts() {
            if (this.searchQuery.trim()) {
                window.location.href = `/products?productName=${encodeURIComponent(this.searchQuery)}`;
            }
        },

    },

}
</script>


<style>
.mobile-menu {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-in-out;
}
</style>
