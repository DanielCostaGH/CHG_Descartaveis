<template>
  <div class="container mx-auto hidden lg:block">
    <!-- Botões de navegação -->
    <div class="flex justify-between items-center bg-[#212844] h-[65vh] rounded-xl">
      <button @click="prev" class="hover: font-bold py-2 px-4">
        <v-icon>
          <img :src="left" alt="">
        </v-icon>
      </button>
      <button @click="next" class="hover: font-bold py-2 px-4">
        <v-icon>
          <img :src="right" alt="">
        </v-icon>
      </button>
    </div>

    <!-- Indicadores de slide -->
    <div class="mt-4 flex justify-center items-center">
      <div
        v-for="(slide, index) in slides"
        :key="index"
        class="h-4 w-4 mr-2 rounded-full"
        :class="{ 'bg-blue-900': currentSlide === index, 'bg-gray-300': currentSlide !== index }"
      ></div>
    </div>

  </div>




  <!-- MOBILE SECTION -->

  <div class="lg:hidden md:w-5/6 md:mx-auto">
    <!-- Botões de navegação -->
    <div class="flex justify-between items-center bg-[#212844] h-[30vh] rounded-xl">
      <button @click="prev" class="hover: font-bold py-2 px-4">
        <v-icon>
          <img class="h-[8vh]" :src="left" alt="">
        </v-icon>
      </button>
      <button @click="next" class="font-bold py-2 px-4 ">
        <v-icon>
          <img class="h-[8vh]" :src="right" alt="">
        </v-icon>
      </button>
    </div>

    <!-- Indicadores de slide -->
    <div class="mt-4 flex justify-center items-center">
      <div
        v-for="(slide, index) in slides"
        :key="index"
        class="h-4 w-4 mr-2 rounded-full"
        :class="{ 'bg-blue-900': currentSlide === index, 'bg-gray-300': currentSlide !== index }"
      ></div>
    </div>

  </div>
</template>

<script>
export default {
  data() {
    return {
      left: '/images/left.svg',
      right: '/images/right.svg',
      currentSlide: 0,
      slides: [
        {
          imageUrl: '/images/name1.jpg',
        },
        {
          imageUrl: '/images/name2.jpg',
        },
        {
          imageUrl: '/images/name3.jpg',
        },
        {
          imageUrl: '/images/name4.jpg',
        }
      ]
    };
  },
  methods: {
    next() {
      if (this.currentSlide < this.slides.length - 1) {
        this.currentSlide++;
      } else {
        this.currentSlide = 0;
      }
    },
    prev() {
      if (this.currentSlide > 0) {
        this.currentSlide--;
      } else {
        this.currentSlide = this.slides.length - 1;
      }
    }
  }
};
</script>

<style scoped>
.container {
  width: 100%;
}
</style>
