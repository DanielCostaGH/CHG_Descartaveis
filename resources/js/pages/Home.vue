<script>
import navbar from '../components/navbar/navbar.vue';
import topics from '../components/topics.vue';
import carrousel from '../components/carrousel.vue';
import products from '../components/products.vue';
import category_scroll from '../components/category-scroll.vue';
import top_marcas from '../components/top-marcas.vue';
import foot from '../components/footer.vue';

export default {
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
  <div id="body" class="">
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

  </div>
</template>

