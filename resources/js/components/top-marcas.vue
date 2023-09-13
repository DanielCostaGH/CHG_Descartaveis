<template>
    <div class="container mx-auto w-full my-10 py-10 z-20">
        <div class="container flex justify-between">
            <h1 class="text-xl">Top Marcas</h1>
            <a class="flex items-center cursor-pointer">
                <span class="px-4">Ver Todos</span>
                <v-icon><img :src="simple_arrow" alt=""></v-icon>
            </a>
        </div>

        <div class="flex justify-between my-10">
            <div
                class="w-96 h-52 flex-shrink-0 rounded-lg cursor-pointer bg-[#313131] hover:bg-[#525252] transition-colors duration-300 ease-in-out">
            </div>

            <div
                class="w-96 h-52 flex-shrink-0 rounded-lg cursor-pointer  bg-[#FFF3CC] hover:bg-[#FFE199] transition-colors duration-300 ease-in-out">
            </div>

            <div
                class="w-96 h-52 flex-shrink-0 rounded-lg cursor-pointer  bg-[#FFECDF] hover:bg-[#FFD2A9] transition-colors duration-300 ease-in-out">
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