<template>
    <div class="container mx-auto flex flex-col my-5 py-3 border-y">

        <!-- MODELO DESKTOP -->

        <section class="lg:flex hidden w-full justify-between items-center text-lg overflow-hidden">

            <div class="text-center">
                <v-menu open-on-hover>
                    <template v-slot:activator="{ props }">
                        <button
                            class="bg-[#212844] text-white rounded-lg py-2 px-5 cursor-pointer shadow hover:text-[#212844] hover:bg-[#D8E1E4] hover:duration-300"
                            v-bind="props">
                            Categorias
                        </button>
                    </template>

                    <v-list class="h-[100vh] w-[100vh]"> <!-- Definindo largura e altura -->
                        <v-list-item v-for="(item, index) in items" :key="index">
                            <v-list-item-title><a href="/{{ item.title }}">{{ item.title }}</a></v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </div>

            <div class="rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Saúde</a>
            </div>

            <div class="rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Limpeza</a>
            </div>

            <div class="rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Alimentação</a>
            </div>

            <div class="rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a href="#">Utilidade</a>
            </div>

            <a href="/"
                class="flex items-center border-2 border-green-600 rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <span class="px-4" href="#">Falar com vendedor</span>
                <v-icon>
                    <img :src="whatsapp" alt="">
                </v-icon>
            </a>
        </section>


        <!-- MODELO MOBILE -->

        <section class="flex lg:hidden w-full justify-between items-center text-lg overflow-scroll">
            <div class="text-center mx-2">
                <v-menu open-on-hover>
                    <template v-slot:activator="{ props }">
                        <button href="/products"
                            class="bg-[#212844] text-white rounded-lg py-2 px-5 cursor-pointer shadow hover:text-[#212844] hover:bg-[#D8E1E4] hover:duration-300">
                            Categorias
                        </button>
                    </template>

                    <v-list class="h-[100vh] w-[100vh]"> <!-- Definindo largura e altura -->
                        <v-list-item v-for="(item, index) in items" :key="index">
                            <v-list-item-title><a href="/{{ item.title }}">{{ item.title }}</a></v-list-item-title>
                        </v-list-item>
                    </v-list>
                </v-menu>
            </div>

            <a href="/products"
                class="flex items-center border-2 border-green-600 rounded-lg py-2 px-2 mx-2 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <span class="px-2" href="#">Falar com vendedor</span>
                <v-icon>
                    <img :src="whatsapp" alt="">
                </v-icon>
            </a>
        </section>

    </div>
</template>
  
<script>
export default {
    data() {
        return {
            whatsapp: '/images/whatsapp.svg',
            items: [
                { title: 'Click Me' },
                { title: 'Click Me' },
                { title: 'Click Me' },
                { title: 'Click Me 2' },
            ],
        };
    },
};
</script>
  