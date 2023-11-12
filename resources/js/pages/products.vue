


<template>
  <navbar/>
<div id="main" class="container mx-auto">
  <filters/>
  <cards/>
</div>
<foot/>


</template>

<script>
import navbar from '../components/navbar/navbar.vue';
import filters from '../components/filters.vue'
import cards from '../components/card-products.vue'
import foot from '../components/footer.vue'

export default {
  data() {
    return {

    }
  },

  components: {
   navbar,
   filters,
   cards,
   foot,

  },
}
</script>

<style>

</style>
