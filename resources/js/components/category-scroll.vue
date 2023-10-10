

<template>
    <div class="container mx-auto my-10  hidden lg:block">
        <div class="container flex justify-between">
            <span class="text-xl">
                Principais categorias!
            </span>

        </div>
        <hr class="border-b-2 border-[#212844] w-1/5 rounded-full my-3" />

        <div class="flex justify-between my-10 text-xl overflow-hidden">
            
            <a class="text-center cursor-pointer mx-3">
                <div class="w-52 h-52 rounded-full border shadow hover:shadow-lg hover:duration:500 mb-5 overflow-hidden flex justify-center items-center">
                    <img src="" alt="">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>

            <a class="text-center cursor-pointer mx-3">
                <div
                    class="w-52 h-52 rounded-full border shadow hover:shadow-lg hover:duration:500 mb-5">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>

            <a class="text-center cursor-pointer mx-3">
                <div
                    class="w-52 h-52 rounded-full border shadow hover:shadow-lg hover:duration:500 mb-5">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>

            <a class="text-center cursor-pointer mx-3">
                <div
                    class="w-52 h-52 rounded-full border shadow hover:shadow-lg hover:duration:500 mb-5">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>

            <a class="text-center cursor-pointer mx-3">
                <div
                    class="w-52 h-52 rounded-full border shadow hover:shadow-lg hover:duration:500 mb-5">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>

            
        </div>
    </div>




    <!-- MOBILE SECTION -->

    <div class="container mx-auto px-2 lg:hidden">
        <div class="flex justify-between">
            <span class="text-xl">
                Melhores Categorias!
            </span>
            <a class="flex items-center cursor-pointer">
                <span class="px-4">Ver Todos</span>
                <v-icon><img :src="simple_arrow" alt=""></v-icon>
            </a>
        </div>
        <hr class="border-b-2 border-[#212844] w-3/5 rounded-full my-2" />

        <div class="flex overflow-x-scroll overflow-y-hidden h-[35vh] items-center">

            <a class="text-center cursor-pointer mx-3">
                <div
                    class="w-52 h-52 rounded-full border shadow-lg mb-5">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>

            <a class="text-center cursor-pointer mx-3">
                <div
                    class="w-52 h-52 rounded-full border shadow-lg mb-5">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>

            <a class="text-center cursor-pointer mx-3">
                <div
                    class="w-52 h-52 rounded-full border shadow-lg mb-5">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>
           
            <a class="text-center cursor-pointer mx-3">
                <div
                    class="w-52 h-52 rounded-full border shadow-lg mb-5">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>

            <a class="text-center cursor-pointer mx-3">
                <div
                    class="w-52 h-52 rounded-full border shadow-lg mb-5">
                </div> 

                <span class="font-bold text-gray-500">Categoria</span>
            </a>

            
        



            

            

        

        </div>


    </div>



</template>


<script>
export default{
    data() {
    return {
        simple_arrow: '/images/simple_arrow.svg',
    }
},
};
</script>