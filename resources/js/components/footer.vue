<script>
import '../../css/sharp.css';
import '../../css/app.css';

export default {
  data() {
    return {
      imagePath: '/images/logo_dark.svg',
      whatsapp_dark: '/images/whatsapp_dark.svg',
      call_dark: '/images/call_dark.svg',
      insta_dark: '/images/insta_dark.svg',
      mail_dark: '/images/mail_dark.svg',
    };
  },
  methods: {
    getCurrentYear() {
      return new Date().getFullYear();
    },
  },
};
</script>

<template>
  <footer class="w-full h-[65vh] flex-shrink-0 bg-[#212844] relative z-0 overflow-hidden">
    <div class="container mx-auto flex justify-between items-center h-5/6 relative">
      <div class="w-[45vh] h-[34vh] flex-shrink-0">
        <img :src="imagePath" alt="">
      </div>

      <div class="w-[38vh] h-[28vh] flex-shrink-0 mr-[35vh]">

        <div class="flex text-white text-xl items-center">
          <img class="px-5 py-8" :src="whatsapp_dark" alt="">
          <span>
            Whats App
            <br>
            (31 8204-1092)
          </span>
        </div>

        <div class="flex text-white text-xl items-center">
          <img class="p-5" :src="call_dark" alt="">
          <span>
            Para ligações
            <br>
            (31 9710-8872)
          </span>
        </div>

        <div class="flex text-white text-xl items-center">
          <img class="p-5" :src="insta_dark" alt="">
          <span>
            @chg_descartaveis
          </span>
        </div>

        <div class="flex text-white text-xl items-center">
          <img class="p-5" :src="mail_dark" alt="">
          <span>
            vendas@chgdescartaveis.com.br
          </span>
        </div>


      </div>
    </div>

  
      <div class="border-t border-gray-300 my-2 z-30 container mx-auto py-4"></div>

      <div class="container text-white z-30 mx-auto text-center">
        <span class="m-5 text-lg">© {{ getCurrentYear() }} CHG Descartáveis Epi’s Limpeza LTDA.</span>
    </div>




    <section>
      <div id="circle_footer"
        class="w-[50vh] h-[50vh] flex-shrink-1 border-0 rounded-full bg-[#68E500] overflow-hidden z-10"
        style="position: absolute; top: -15vh; right: -15vh;"></div>

      <div id="circle_footer_2"
        class="w-[51.5vh] h-[51.5vh] flex-shrink-1 border-4 border-[#68E500] overflow-hidden rounded-full z-10"
        style="position: absolute; top: -15vh; right: -15vh;"></div>
    </section>




  </footer>
</template>

<style scoped></style>


  