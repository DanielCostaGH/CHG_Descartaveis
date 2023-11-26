<template>
    <div class="container mx-auto hidden lg:block container mx-auto w-full   z-20">
        <div class="mt-10">
            <v-row justify="space-between" align="center">
                <v-col cols="auto">
                    <span class="text-h6 ml-2">Top Marcas</span>
                </v-col>
                <v-col cols="auto" class="text-right">
                    <v-btn class="mx-2" text :href="'/products'">
                        Ver Todos
                        <v-icon right>
                            mdi-arrow-right
                        </v-icon>
                    </v-btn>
                </v-col>
            </v-row>
        </div>
        <hr class="border-b-2 border-[#212844] w-1/5 rounded-full my-3" />

        <div class="flex justify-between my-10 py-5 overflow-hidden h-[30vh]">


            <div v-for="(brand, index) in brands" :key="index"
                class="overflow-hidden w-[40vh] h-5/6 rounded-lg cursor-pointer border mx-5 shadow-lg">
                <img :src="brand.image" :alt="brand.name" style="width: 100%; height: 100%; object-fit: cover;">
            </div>

        </div>
    </div>





     <!-- MOBILE SECTION -->
  <div class="lg:hidden container mx-auto w-full my-10  z-20 px-2">
    <div class="flex justify-between">
      <span class="text-xl">Top Marcas!</span>
      <a class="flex items-center cursor-pointer">
        <span class="px-4">Ver Todos</span>
        <v-icon><img :src="simple_arrow" alt=""></v-icon>
      </a>
    </div>
    <hr class="border-b-2 border-[#212844] w-3/5 rounded-full my-2" />

    <div class="flex my-10 overflow-scroll">
      <div class="flex h-[30vh] w-auto py-2">
        <div v-for="(brand, index) in brands" :key="index" class="overflow-hidden w-[40vh] h-5/6 rounded-lg cursor-pointer border mx-5 shadow-lg">
            <img :src="brand.image" :alt="brand.name" style="width: 100%; height: 100%; object-fit: cover;">        </div>
      </div>
    </div>
  </div>
</template>



<script>
import axios from 'axios';

export default {
    data() {
        return {
            simple_arrow: '/images/simple_arrow.svg',

            brands: [],
        };
    },


    methods:{
        fetchBrands(){
            axios.get('/api/brands/get')
            .then(response =>{
                this.brands = response.data.map(brand => ({
                    ...brand,
                    image: `/images/brands/${brand.images}`
                }));
            })
            .catch((error) => {
            });
        }
    },

    mounted(){
        this.fetchBrands();
    }
};

</script>
