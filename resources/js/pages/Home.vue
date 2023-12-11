<template>
    <div class="overflow-hidden">
        <navbar />
        <topics />
        <slides />
        <products />
        <category_scroll />
        <top_marcas />
        <foot />


        <div class="whatsapp-btn">
            <a href="https://api.whatsapp.com/send?phone=31980160125" target="_blank">
                <img :src="wpp" alt="WhatsApp Icon">
            </a>
        </div>
    </div>
</template>

<script>
import navbar from '../components/navbar/navbar.vue';
import topics from '../components/topics.vue';
import products from '../components/products.vue';
import category_scroll from '../components/category-scroll.vue';
import top_marcas from '../components/top-marcas.vue';
import foot from '../components/footer.vue';
import slides from '../components/slides.vue';

export default {
    data() {
    return {
      wpp: 'images/wpp2.svg',
    }
  },

  computed: {
    userInfo() {
      return this.$store.state.user;
    },
  },

    components: {
        navbar,
        topics,
        products,
        category_scroll,
        top_marcas,
        foot,
        slides
    }
};
</script>


<style>
.whatsapp-btn {
  position: fixed;
  bottom: 50px;
  right: 50px;
  z-index: 1000;
}

.whatsapp-btn img {
  height: 6vh;
  width: 6vh;
  transition: transform 0.3s;
}

.whatsapp-btn img:hover {
  transform: scale(1.1);
}

@media (min-width: 992px) {
  .whatsapp-btn img {
    height: 10vh;
    width: 10vh;
  }
}

@media (max-width: 400px) {
  .whatsapp-btn {
    bottom: 10px;
    right: 10px;
  }

  .whatsapp-btn img {
    height: 50px;
    width: 50px;
  }
}
</style>
