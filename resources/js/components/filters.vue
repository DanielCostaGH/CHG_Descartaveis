<template>
    <div class="container mx-auto flex flex-col my-5 py-3 border-y">
        <section class="lg:flex w-full items-center text-lg justify-between hidden">
            <div class="flex items-center">
                <span>Filtros de pesquisa:</span>


                <!-- dropdown -->
                <div class="relative">
                    <button @pointerover="isOpen = !isOpen"
                        class="flex items-center rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                        <span>Categorias </span>
                        <img class="ml-3 w-[2vh]" :src="down_arrow" alt="">
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



            </div>


            <!-- Botão para abrir a modal de filtros -->
            <button @click="openFilterModal"
                class="flex items-center justify-between rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mr-3">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                </svg>


                Filtros
            </button>
        </section>


        <!-- MOBILE SECTION -->

        <section class="flex w-full items-center text-lg justify-between lg:hidden">
            <div class="flex items-center px-5">
                <span>Filtros de pesquisa:</span>

            </div>


            <!-- Botão para abrir a modal de filtros -->
            <button @click="openFilterModal"
                class="flex items-center justify-between rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                </svg>

            </button>
        </section>

        <!-- Modal de Filtros -->
        <div v-if="showFilterModal" class="fixed inset-0 flex items-center justify-center z-50" @click="closeFilterModal"
            style="background-color: rgba(0, 0, 0, 0.5);">

            <main class="bg-white p-6 rounded-lg shadow-lg h-[70vh] w-[50vh] text-gray-800" @click.stop>

                <div class="h-5/6">
                    <div class="w-full flex justify-between">

                        <h2 class="text-lg font-semibold mb-4">Filtros</h2>

                        <button @click="closeFilterModal"
                            class="rounded-lg text-red-500 hover:text-red-700 flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>


                    <div class="w-full flex items-center  my-5">
                        <label class="w-2/5" for="">Categoria:</label>
                        <select class="p-3 rounded bg-white border w-3/5" name="categorias" id="">
                            <option value="">Escolha a categoria</option>
                            <option value="">categoria</option>
                            <option value="">categoria</option>
                        </select>
                    </div>

                    <div class="w-full flex items-center justify-between my-5">
                        <label class="mr-3 w-2/5" for="">Marca:</label>
                        <select class="p-3 rounded bg-white border w-3/5" name="categorias" id="">
                            <option value="">Escolha a marca</option>
                            <option value="">marca</option>
                            <option value="">marca</option>
                        </select>
                    </div>

                    <div class="w-full flex items-center justify-between my-5">
                        <label class="mr-3 w-2/5" for="">Cor:</label>
                        <select class="p-3 rounded bg-white border w-3/5" name="categorias" id="">
                            <option value="">Escolha a Cor</option>
                            <option value="">Cor</option>
                            <option value="">Cor</option>
                        </select>
                    </div>

                    <div class="w-full flex items-center justify-between my-5">
                        <label class="mr-3 w-2/5" for="">Variação:</label>
                        <select class="p-3 rounded bg-white border w-3/5" name="categorias" id="">
                            <option value="">Escolha a Variação</option>
                            <option value="">Variação</option>
                            <option value="">Variação</option>
                        </select>
                    </div>

                    <div class="w-full flex items-center justify-between my-5">
                        <label class="mr-3 w-2/5" for="">Status do produto</label>
                        <select class="p-3 rounded bg-white border w-3/5" name="categorias" id="">
                            <option value="">Escolha a Variação</option>
                            <option value="">Variação</option>
                            <option value="">Variação</option>
                        </select>
                    </div>

                    <div class="w-full flex items-center justify-between my-5">
                        <label class="mr-3 w-2/5" for="">Valor <span class="font-semibold">abaixo</span> de:</label>
                        <input type="number" placeholder="Digite o valor" class="border  p-3 rounded w-3/5">
                    </div>

                    <div class="w-full flex items-center justify-between my-5">
                        <label class="mr-3 w-2/5" for="">Valor acima de:</label>
                        <input type="number" placeholder="Digite o valor" class="border w-3/5 p-3 rounded">
                    </div>


                </div>




                <div class="flex w-full justify-end items-center mt-10">

                    <button @click="closeFilterModal"
                        class="px-4 py-2 rounded-lg text-white bg-blue-400 hover:bg-blue-500 flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 mr-3">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>


                        Pesquisar</button>
                </div>

            </main>
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
  