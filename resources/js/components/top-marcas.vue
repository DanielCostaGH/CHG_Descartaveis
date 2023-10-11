<template>
    <div class="hidden lg:block container mx-auto w-full my-10 py-10 z-20">
        <div class="container flex justify-between">
            <h1 class="text-xl">Top Marcas</h1>
            <a class="flex items-center cursor-pointer">
                <span class="px-4">Ver Todos</span>
                <v-icon><img :src="simple_arrow" alt=""></v-icon>
            </a>
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
        <div class="flex justify-between">
            <span class="text-xl">
                Top Marcas!
            </span>
            <a class="flex items-center cursor-pointer">
                <span class="px-4">Ver Todos</span>
                <v-icon><img :src="simple_arrow" alt=""></v-icon>
            </a>
        </div>
        <hr class="border-b-2 border-[#212844] w-3/5 rounded-full my-2" />

        <div class="flex my-10 overflow-scroll ">

            <div class="flex h-[30vh] w-auto py-2">
                <div class="overflow-hidden w-[40vh] h-5/6 rounded-lg cursor-pointer border mx-5 shadow-lg">

                </div>

                <div class="overflow-hidden w-[40vh] h-5/6 rounded-lg cursor-pointer border mx-5 shadow-lg">

                </div>

                <div class="overflow-hidden w-[40vh] h-5/6 rounded-lg cursor-pointer border mx-5 shadow-lg">

                </div>
            </div>




        </div>
    </div>
</template>



<script>
export default {
    data() {
        return {
            simple_arrow: '/images/simple_arrow.svg'
        };
    },
};

</script>