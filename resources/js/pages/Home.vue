<script>
import navbar from '../components/navbar/navbar.vue';
import topics from '../components/topics.vue';
import carrousel from '../components/carrousel.vue';
import products from '../components/products.vue';
import category_scroll from '../components/category-scroll.vue';
import top_marcas from '../components/top-marcas.vue';
import foot from '../components/footer.vue';



export default {
  data() {
    return {
      wpp: 'images/wpp2.svg',
    }
  },
  
  components: {
    navbar,
    topics,
    carrousel,
    products,
    category_scroll,
    top_marcas,
    foot,
  },

  

}
</script>



<template>
  <div id="main" class="">
    <div>
      <navbar />
    </div>

    <div>
      <topics/>
    </div>

    <div>
      <carrousel/>
    </div>

    <div>
      <products/>
    </div>

    <div>
      <category_scroll/>
    </div>

    <div>
      <top_marcas/>
    </div>

    <div>
      <foot/>
    </div>

    <div class="fixed bottom-20 right-5 z-50">
      <a href="https://api.whatsapp.com/send?phone=31980160125" target="_blank">
        <img :src="wpp" class="h-[6vh] :w-[6-vh] lg:h-[10vh] lg:w-[10-vh] rounded-xl hover hover:shadow" alt="WhatsApp Icon">
      </a>
    </div>


  </div>
</template>

