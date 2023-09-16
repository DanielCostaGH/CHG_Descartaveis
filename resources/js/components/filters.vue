<script>
export default {
    data(){
        return{
            arrowDown: '/images/arrow.svg'
        }
           
        
    }
}
</script>

<template>
    <div class="container mx-auto flex flex-col my-5 py-3 border-y">

        <section class="flex w-full items-center text-lg">

            <span>Filtros de pesquisa:</span>

            <div class="rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Categoria </a>
                <!-- <v-icon><img :src="arrowDown" class="" alt=""></v-icon> -->
            </div>

            <div class="rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Preço</a>
            </div>

            <div class="rounded-lg py-2 px-5 mx-10 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Mais vendidos</a>
            </div>
        </section>

    </div>
</template>