
<template>
    <div class="container mx-auto my-10 py-10">
        <div class="container flex justify-between">
            <span class="text-xl">
                Consiga os melhores produtos com os melhores preços!
            </span>
            <a class="flex items-center cursor-pointer">
                <span class="px-4">Ver Todos</span>
                <v-icon><img :src="simple_arrow" alt=""></v-icon>
            </a>

        </div>


        <div class="flex justify-between my-10">

            <!-- Card de produtos -->
            <div class="w-[23vh] h-[30vh] flex-shrink-0 border rounded-xl border-transparent bg-[#F5F5F5] gray-200 shadow-lg hover:border-green-600"
                style="position: relative;">

                <div class="bg-white w-full h-2/5 absolute bottom-0 rounded-b-xl">
                    <div class="relative px-4 py-2 text-lg">
                        <span class="">Produto 1</span> <br />
                        <span class="">R$00,00 </span>
                        <hr class="my-2 border-t-2 border-gray-300">
                        <span class="bold text-green-900">Economize: R$00,00</span>
                    </div>
                </div>
            </div>

            <!-- Card de produtos -->
            <div class="w-[23vh] h-[30vh] flex-shrink-0 border rounded-xl border-transparent bg-[#F5F5F5] gray-200 shadow-lg hover:border-green-600"
                style="position: relative;">

                <div class="bg-white w-full h-2/5 absolute bottom-0 rounded-b-xl">
                    <div class="relative px-4 py-2 text-lg">
                        <span class="">Produto 1</span> <br />
                        <span class="">R$00,00 </span>
                        <hr class="my-2 border-t-2 border-gray-300">
                        <span class="bold text-green-900">Economize: R$00,00</span>
                    </div>
                </div>
            </div>

            <!-- Card de produtos -->
            <div class="w-[23vh] h-[30vh] flex-shrink-0 border rounded-xl border-transparent bg-[#F5F5F5] gray-200 shadow-lg hover:border-green-600"
                style="position: relative;">

                <div class="bg-white w-full h-2/5 absolute bottom-0 rounded-b-xl">
                    <div class="relative px-4 py-2 text-lg">
                        <span class="">Produto 1</span> <br />
                        <span class="">R$00,00 </span>
                        <hr class="my-2 border-t-2 border-gray-300">
                        <span class="bold text-green-900">Economize: R$00,00</span>
                    </div>
                </div>
            </div>

            <!-- Card de produtos -->
            <div class="w-[23vh] h-[30vh] flex-shrink-0 border rounded-xl border-transparent bg-[#F5F5F5] gray-200 shadow-lg hover:border-green-600"
                style="position: relative;">

                <div class="bg-white w-full h-2/5 absolute bottom-0 rounded-b-xl">
                    <div class="relative px-4 py-2 text-lg">
                        <span class="">Produto 1</span> <br />
                        <span class="">R$00,00 </span>
                        <hr class="my-2 border-t-2 border-gray-300">
                        <span class="bold text-green-900">Economize: R$00,00</span>
                    </div>
                </div>
            </div>

            <!-- Card de produtos -->
            <div class="w-[23vh] h-[30vh] flex-shrink-0 border rounded-xl border-transparent bg-[#F5F5F5] gray-200 shadow-lg hover:border-green-600"
                style="position: relative;">

                <div class="bg-white w-full h-2/5 absolute bottom-0 rounded-b-xl">
                    <div class="relative px-4 py-2 text-lg">
                        <span class="">Produto 1</span> <br />
                        <span class="">R$00,00 </span>
                        <hr class="my-2 border-t-2 border-gray-300">
                        <span class="bold text-green-900">Economize: R$00,00</span>
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
            simple_arrow: '/images/simple_arrow.svg'
        };
    },
};

</script>