<template>
    <div class="container mx-auto flex flex-col my-5 py-3 border-y">

        <!-- MODELO DESKTOP -->

        <section class="lg:flex hidden w-full justify-between items-center text-lg overflow-hidden">
            <div class="rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Categorias</a>
            </div>

            <div class="rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Saúde</a>
            </div>

            <div class="rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Limpeza</a>
            </div>

            <div class="rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="cursor-pointer" href="#">Alimentação</a>
            </div>

            <div class="rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a href="#">Utilidade</a>
            </div>

            <div
                class="flex items-center border-2 border-green-600 rounded-lg py-2 px-5 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
                <a class="px-4" href="#">Falar com vendedor</a>
                <v-icon>
                    <img :src="whatsapp" alt="">
                </v-icon>
            </div>
        </section>


        <!-- MODELO MOBILE -->

        <section class="flex lg:hidden w-full justify-between items-center text-lg overflow-scroll">
        <div class="rounded-lg py-2 px-5 ml-2 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
          <a class="cursor-pointer" href="#">Categorias</a>
        </div>
  
        <div class="flex items-center border-2 border-green-600 rounded-lg py-2 px-2 mx-2 cursor-pointer bg-[#F3F9FB] shadow hover hover:bg-[#D8E1E4]">
          <a class="px-2" href="#">Falar com vendedor</a>
          <v-icon>
            <img :src="whatsapp" alt="">
          </v-icon>
        </div>
      </section>

    </div>
</template>
  
<script>
export default {
    data() {
        return {
            whatsapp: '/images/whatsapp.svg'
        };
    },
};
</script>
  