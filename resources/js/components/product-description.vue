<template>
  <div class="my-10 w-11/12">
    <span class="text-xl text-gray-600">
      Descrição:
    </span>
    <p class="text-justify my-5 text-gray-500">{{product.description}}</p>
  </div>
</template>

<script>
export default {
  props: {
    product: Object,
  },
  data() {
    return {
    };
  },

};
</script>
