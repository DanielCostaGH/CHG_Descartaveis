<template>
    <div class="hidden lg:block container mx-auto w-full my-10 py-10 z-20">
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

        <div class="flex justify-between my-10 py-5 overflow-hidden">


            <div
                class="overflow-hidden w-96 h-52 rounded-lg cursor-pointer border mx-5 shadow-lg transition-transform transform scale-100 hover:scale-105">

            </div>

            <div
                class="overflow-hidden w-96 h-52 rounded-lg cursor-pointer border mx-5 shadow-lg transition-transform transform scale-100 hover:scale-105">

            </div>

            <div
                class="overflow-hidden w-96 h-52 rounded-lg cursor-pointer border mx-5 shadow-lg transition-transform transform scale-100 hover:scale-105">

            </div>

        </div>
    </div>





    <!-- MOBILE SECTION -->

    <div class="lg:hidden container mx-auto w-full my-10  z-20 px-2">
        <v-row justify="space-between" align="center">
                <v-col cols="auto">
                    <span class="text-h6 ml-2">Top Categorias!</span>
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

        <div class="flex my-10 overflow-scroll ">

            <div class="flex h-[30vh] w-auto py-2">
                <v-row>
      <v-col cols="12" lg="4" v-for="brand in brands" :key="brand.name" class="my-5">
        <div class="overflow-hidden w-full h-52 lg:w-96 rounded-lg cursor-pointer border shadow-lg transition-transform transform scale-100 hover:scale-105">
          <img :src="brand.image" alt="Brand Image" class="w-full h-full">
        </div>
      </v-col>
    </v-row>
            </div>




        </div>
    </div>
</template>



<script>
export default {
    data() {
        return {
            simple_arrow: '/images/simple_arrow.svg',

            brands: [
        { name: "Brand 1", image: "/images/Brands/b1.png" },
        { name: "Brand 2", image: "/images/products/1/i1.png" },
        { name: "Brand 3", image: "path-to-image/brand3.jpg" },
      ],
        };
    },
};

</script>
