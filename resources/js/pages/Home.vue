<script>
import navbar from '../components/navbar/navbar.vue';
import category from '../components/category.vue';
import carrousel from '../components/carrousel.vue';
import products from '../components/products.vue';
import category_scroll from '../components/category-scroll.vue'

export default {
  components: {
    navbar,
    category,
    carrousel,
    products,
    category_scroll
  },

}
</script>



<template>
  <div id="body">
    <div>
      <navbar />
    </div>

    <div>
      <category/>
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

  </div>
</template>

