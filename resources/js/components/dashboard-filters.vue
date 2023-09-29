<template>
    <div class="container mx-auto flex flex-col my-5 py-3 border-y">
        <section class="flex w-full items-center text-lg">
            <span>Filtros de pesquisa:</span>

           
            <!-- dropdown -->
            <div class="relative">
                <button @click="isOpen = !isOpen" class="flex items-center rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                    <span>Categorias </span>
                    <img class="mx-3" :src="down_arrow" alt="">
                </button>
                <div v-if="isOpen" class="absolute mt-2 w-48 bg-white rounded shadow-lg py-2 z-20">
                    <a href="#" class="block px-4 py-2 hover hover:bg-gray-100">Item 1</a>
                    <a href="#" class="block px-4 py-2 hover hover:bg-gray-100">Item 2</a>
                    <a href="#" class="block px-4 py-2 hover hover:bg-gray-100">Item 3</a>
                </div>
            </div>

            <!-- end dropdown -->



            <div class="rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Menor Preço</a>
            </div>

            <div class="rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Maior Preço</a>
            </div>

            <div class="rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Mais vendidos</a>
            </div>


             <!-- Botão para abrir a modal de filtros -->
             <button @click="openFilterModal"
                class="rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                Abrir Filtros
            </button>
        </section>

        <!-- Modal de Filtros -->
        <div v-if="showFilterModal" class="fixed inset-0 flex items-center justify-center z-50"
            style="background-color: rgba(0, 0, 0, 0.5);">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <!-- Conteúdo da modal de filtros aqui -->
                <h2 class="text-lg font-semibold mb-4">Filtros</h2>
                <!-- Adicione seus filtros personalizados aqui -->
                <button @click="closeFilterModal" class="bg-gray-300 px-4 py-2 rounded-lg hover:bg-gray-400">Fechar</button>
            </div>
        </div>
    </div>
</template>
  
<script>

export default {
    data() {
        return {
            down_arrow: '/images/down_arrow.svg',
            up_arrow: '/images/up_arrow.svg',
            showFilterModal: false,
            isDropdownOpen: false,
            isOpen: false
        };
    },
    methods: {
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },
        openFilterModal() {
            this.showFilterModal = true;
        },
        closeFilterModal() {
            this.showFilterModal = false;
        },
    },
};
</script>
  