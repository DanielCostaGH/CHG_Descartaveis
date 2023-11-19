<template>
  <div class="bg-white w-full h-[70vh] flex">

    <!-- div cards -->
    <div class="h-full w-3/12 my-5">
      <div class=""><img class="mx-auto my-5" :src="up_arrow" alt="seta"></div>

      <!-- cards -->
      <div id="product_images" class="overflow-scroll h-5/6">
        <div v-for="(image, index) in productImages" :key="index" @click="displayImage(image)"
          class="bg-white border-2 border-gray-500 hover hover:border-blue-500 rounded h-[12vh] w-[12vh] mx-auto my-5 cursor-pointer flex items-center justify-center">
          <img class="h-5/6 w-5/6" :src="`/images/products/${product.id}/${image}`" :alt="image">
        </div>
      </div>


      <div class=""><img class="mx-auto my-5" :src="down_arrow" alt="seta"></div>
    </div>

    <!-- imagem principal -->
    <div id="main_image" class="w-9/12 h-full flex items-center ">
      <img class="h-5/6 w-auto mx-auto" :src="selectedImage" alt="">
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      up_arrow: '/images/up_arrow.svg',
      down_arrow: '/images/down_arrow.svg',
      selectedImage: '',
    };
  },
  props: {
    product: Object,
  },
  computed: {
    productImages() {
      return this.product.images.split(';').filter(image => image !== '');
    },
  },
  mounted() {
    if (this.productImages.length > 0) {
      this.selectedImage = `/images/products/${this.product.id}/${this.productImages[0]}`;
    }
  },
  methods: {
    displayImage(image) {
      this.selectedImage = `/images/products/${this.product.id}/${image}`;
    },
  },
};
</script>
