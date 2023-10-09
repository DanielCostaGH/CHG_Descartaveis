

<template>
    <div class="container mx-auto my-10 py-10 hidden lg:block">
        <div class="container flex justify-between">
            <span class="text-xl">
                Veja nossas categorias de produtos
            </span>

        </div>

        <div class="flex justify-between my-10 text-xl overflow-x-scroll">
            
            <div class="text-center">
                <div
                    class="w-52 h-52 rounded-full bg-[#F5F5F5] hover:border hover:border-blue-900 hover:shadow-lg">
                </div> <br>

                <span class="" style="padding-top: 40px;">Categoria</span>
            </div>

            <div class="text-center">
                <div
                    class="w-52 h-52 rounded-full bg-[#F5F5F5] hover:border hover:border-blue-900 hover:shadow-lg">
                </div> <br>

                <span class="" style="padding-top: 40px;">Categoria</span>
            </div>

            <div class="text-center">
                <div
                    class="w-52 h-52 rounded-full bg-[#F5F5F5] hover:border hover:border-blue-900 hover:shadow-lg">
                </div> <br>

                <span class="" style="padding-top: 40px;">Categoria</span>
            </div>

            <div class="text-center">
                <div
                    class="w-52 h-52 rounded-full bg-[#F5F5F5] hover:border hover:border-blue-900 hover:shadow-lg">
                </div> <br>

                <span class="" style="padding-top: 40px;">Categoria</span>
            </div>

            <div class="text-center">
                <div
                    class="w-52 h-52 rounded-full bg-[#F5F5F5] hover:border hover:border-blue-900 hover:shadow-lg">
                </div> <br>

                <span class="" style="padding-top: 40px;">Categoria</span>
            </div>

            
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