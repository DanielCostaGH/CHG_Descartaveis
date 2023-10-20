

<template>
    <div class="hidden lg:block container mx-auto mt-10  ">
        <div class="container flex justify-between">
            <span class="text-xl">
                Melhores produtos!
            </span>
            <a class="flex items-center cursor-pointer">
                <a href="/products" class="px-4">Ver Todos</a>
                <v-icon><img :src="simple_arrow" alt=""></v-icon>
            </a>
        </div>
        <hr class="border-b-2 border-[#212844] w-1/5 rounded-full my-3" />

        <div class="flex justify-between overflow-hidden">

            <!-- Card de produtos -->
            <div v-for="(product, index) in products" :key="index" class="w-[34vh] h-[45vh] my-10 mx-5 px-4 pb-4 bg-white rounded-lg duration-200 border border-gray-300 hover:shadow-lg cursor-pointer"
                style="position: relative;">

                <div class="h-3/5 relative">

                    <div class=" w-full flex items-center justify-between h-1/5">
                        <div class="flex mx-1 items-center">
                            <v-rating class="text-yellow-500" v-model="rating" density="compact" half-increments readonly
                                size="md">
                                <template v-slot:item="{ value, isFilled }">
                                    <svg xmlns="http://www.w3.org/2000/svg" :fill="isFilled ? 'currentColor' : 'none'"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                    </svg>
                                </template>
                            </v-rating>
                            <span class="text-gray-500">({{ product.rating }})</span>
                        </div>
                        <div class="mx-2">
                            <button>
                                <v-icon variant="text" @click="isChecked = !isChecked" class="no-hover">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        :class="isChecked ? 'fill-current text-red-600' : 'fill-none'" stroke-width="1.5"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </v-icon>
                            </button>
                        </div>
                    </div>

                    <div class="flex w-full h-4/5 bg-gray-100 ">
                        <img class="" :src="image" alt="">
                    </div>

                </div>

                <div class="w-full h-2/5 flex flex-wrap p-2 text-lg ">

                    <div class="h-4/5 w-full">
                        <div class="flex items-center w-full overflow-hidden h-3/6">
                            <span class="text-base">({{ product.name }})</span>
                        </div>
                        <div class="flex items-center w-full border-t-2 border-gray-300 h-3/6">
                            <span class="text-base font-bold text-green-700">R${{ product.price }}</span>
                        </div>
                    </div>

                    <div class="h-1/5 w-full flex items-center">
                        <button class="flex items-center justify-center w-full rounded-lg p-1 bg-[#212844] text-white">
                            <div
                                class="transition-transform transform scale-100 hover:scale-105 flex w-full h-full items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-[4vh] h-[4vh] mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-base font-bold">Adicionar ao carrinho</span>
                            </div>
                        </button>


                    </div>


                </div>
            </div>


        </div>
    </div>






    <!-- MOBILE -->

    <div class="lg:hidden pt-10 px-2 px-2">
        <div class="flex justify-between">
            <span class="text-xl">
                Melhores Produtos!
            </span>
            <a class="flex items-center cursor-pointer">
                <span class="px-4">Ver Todos</span>
                <v-icon><img :src="simple_arrow" alt=""></v-icon>
            </a>
        </div>
        <hr class="border-b-2 border-[#212844] w-3/5 rounded-full my-2" />

        <div class="flex overflow-x-scroll">


            <div class="flex h-[32vh] w-auto items-center">

                <!-- Card de produtos -->
                <div v-for="(product, index) in products" :key="index" class="border mx-2 items-stretch h-5/6">

                    <div class="h-1/6 w-full px-1 flex items-center justify-between">
                        <div class="flex mx-1 items-center">
                            <v-rating class="text-yellow-500" v-model="rating" density="compact" half-increments readonly
                                size="md">
                                <template v-slot:item="{ value, isFilled }">
                                    <svg xmlns="http://www.w3.org/2000/svg" :fill="isFilled ? 'currentColor' : 'none'"
                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M11.48 3.499a.562.562 0 011.04 0l2.125 5.111a.563.563 0 00.475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 00-.182.557l1.285 5.385a.562.562 0 01-.84.61l-4.725-2.885a.563.563 0 00-.586 0L6.982 20.54a.562.562 0 01-.84-.61l1.285-5.386a.562.562 0 00-.182-.557l-4.204-3.602a.563.563 0 01.321-.988l5.518-.442a.563.563 0 00.475-.345L11.48 3.5z" />
                                    </svg>
                                </template>
                            </v-rating>
                            <span class="text-gray-500">({{ product.rating }})</span>
                        </div>
                        <div class="mx-2">
                            <button>
                                <v-icon variant="text" @click="isChecked = !isChecked" class="no-hover">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        :class="isChecked ? 'fill-current text-red-600' : 'fill-none'" stroke-width="1.5"
                                        stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                    </svg>
                                </v-icon>
                            </button>
                        </div>
                    </div>

                    <div class="flex w-[40vh] h-3/6 ">

                        <div class="bg-[#F5F5F5] w-3/6 h-full mx-2">
                            <img :src="image" alt="">
                        </div>

                        <div class="bg-white w-3/6 h-full">
                            <div class="flex flex-wrap px-4 py-2 text-sm font-bold h-full">
                                <div class="w-full h-2/3 overflow-hidden">
                                    <span class=""> {{ product.name }} </span> <br />
                                </div>

                                <div class="w-full h-1/3 border-t my-2 py-2">
                                    <span class="bold text-green-900">R${{product.price}}</span>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="h-2/6 w-full px-1 flex items-center">
                        <button
                            class="flex items-center justify-center rounded w-full p-2 bg-[#212844] text-white text-sm font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-[4vh] h-[4vh] mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Adicionar ao carrinho
                        </button>
                    </div>
                </div>

            </div>

        </div>
    </div>
</template>


<script>
export default {
  data() {
    return {
      simple_arrow: '/images/simple_arrow.svg',
      rating: 4,
      isChecked: false,
      products: [
        {
          name: 'Produto 1',
          price: '100,00',
          rating: 4.5,
          image: 'public/images/1/i1.png'
        },
        {
          name: 'Produto 2',
          price: '150,00',
          rating: 4.2,
          image: '/images/1/i1.png'
        },
        {
          name: 'Produto 3',
          price: '120,00',
          rating: 4.0,
          image: '/images/1/i1.png'
        },
        {
          name: 'Produto 4',
          price: '90,00',
          rating: 4.8,
          image: '/images/1/i1.png'
        },
    
      ],
    };
  },
  methods: {},
};
</script>
