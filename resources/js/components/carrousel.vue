<template>
    <div class="container mx-auto">
      <div class="flex justify-between items-center bg-blue-900 h-72 rounded-xl">
        <button @click="prev" class="bg-white hover:bg-gray-300 font-bold py-2 px-4 ">Anterior</button>
        <button @click="next" class="bg-white hover:bg-gray-300 font-bold py-2 px-4 ">Próximo</button>
      </div>
      <div class="mt-4 flex justify-start items-center">
        <div v-for="(slide, index) in slides" :key="index" class="h-4 w-4 mr-2 rounded-full" :class="{ 'bg-blue-900': currentSlide === index, 'bg-gray-300': currentSlide !== index }"></div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        currentSlide: 0,
        slides: [1, 2, 3, 4, 5] 
      }
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
  }
  </script>
  
  <style scoped>
  .container {
    width: 100%;
  }
  </style>
  