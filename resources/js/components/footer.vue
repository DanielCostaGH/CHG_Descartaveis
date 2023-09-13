<script>
import '../../css/sharp.css';
import '../../css/app.css';

export default {
data() {
    return {
      imagePath: '/images/logo_dark.svg',
    };
  },
};
</script>

<template>
    <footer class="w-full h-[65vh] flex-shrink-0 bg-[#212844] relative z-0">
      <div class="container mx-auto flex justify-between items-center h-full relative">
        <div class="w-[45vh] h-[34vh] flex-shrink-0">
          <img :src="imagePath" alt="">
        </div>
  
        <div class="w-[38vh] h-[28vh] border flex-shrink-0 mr-[35vh]">
          <!-- Conteúdo do div retangular -->
        </div>
      </div>
  
      <div id="circle_footer" class="w-[50vh] h-[50vh] flex-shrink-1 border-0 rounded-full bg-[#68E500] overflow-hidden z-10"></div>
  
      <div id="circle_footer_2" class="w-[52vh] h-[52vh] flex-shrink-1 border-4 border-[#68E500] overflow-hidden rounded-full z-10"></div>
    </footer>
  </template>
  
  <style scoped>
  #circle_footer {
    position: absolute;
    top: -15vh;
    right: -15vh;
  }
  
  #circle_footer_2 {
    position: absolute;
    top: -15vh;
    right: -15vh;
  }
  </style>
  