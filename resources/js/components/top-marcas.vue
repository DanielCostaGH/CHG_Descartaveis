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

        <div class="flex justify-between my-10 overflow-hidden">


            <div
                class="relative overflow-hidden w-96 h-52 flex-shrink-0 rounded-lg cursor-pointer bg-[#313131] hover:bg-[#525252] transition-colors duration-300 ease-in-out">
                <section>
                    <div id="circle_footer"
                        class="w-[20vh] h-[20vh] flex-shrink-1 border-0 rounded-full bg-[#525252] overflow-hidden z-10"
                        style="position: absolute; top: -5vh; right: -5vh;"></div>

                    <div id="circle_footer_2"
                        class="w-[21vh] h-[21vh] flex-shrink-1 border-2 border-[#525252] overflow-hidden rounded-full z-10"
                        style="position: absolute; top: -5vh; right: -5vh;"></div>
                </section>
            </div>

            <div
                class="relative overflow-hidden w-96 h-52 flex-shrink-0 rounded-lg cursor-pointer  bg-[#FFF3CC] hover:bg-[#FFE199] transition-colors duration-300 ease-in-out">
                <section>
                    <div id="circle_footer"
                        class="w-[20vh] h-[20vh] flex-shrink-1 border-0 rounded-full bg-[#FFE199] overflow-hidden z-10"
                        style="position: absolute; top: -5vh; right: -5vh;"></div>

                    <div id="circle_footer_2"
                        class="w-[21vh] h-[21vh] flex-shrink-1 border-2 border-[#FFE199] overflow-hidden rounded-full z-10"
                        style="position: absolute; top: -5vh; right: -5vh;"></div>
                </section>
            </div>

            <div
                class="relative overflow-hidden w-96 h-52 flex-shrink-0 rounded-lg cursor-pointer  bg-[#FFECDF] hover:bg-[#FFD2A9] transition-colors duration-300 ease-in-out">
                <section>
                    <div id="circle_footer"
                        class="w-[20vh] h-[20vh] flex-shrink-1 border-0 rounded-full bg-[#FFD2A9] overflow-hidden z-10"
                        style="position: absolute; top: -5vh; right: -5vh;"></div>

                    <div id="circle_footer_2"
                        class="w-[21vh] h-[21vh] flex-shrink-1 border-2 border-[#FFD2A9] overflow-hidden rounded-full z-10"
                        style="position: absolute; top: -5vh; right: -5vh;"></div>
                </section>
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