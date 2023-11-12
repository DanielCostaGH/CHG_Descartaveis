<template>
  <div class="my-10 w-11/12">
    <span class="text-xl text-gray-600">
      Descrição:
    </span>
    <p class="text-justify my-5 text-gray-500">{{product.description}}</p>
    <!-- <span>{{ productDescription }}</span> -->
  </div>
</template>

<script>
export default {
  props: {
    product: Object,
  },
  data() {
    return {
      // productDescription: '',
    };
  },
  // created() {
  //   console.log(`/api/product/details/${this.productId}/description`);
  //   axios.get(`/api/product/details/${this.productId}/description`)

  //     .then((response) => {
  //       this.productDescription = response.data.description;
  //     })
  //     .catch((error) => {
  //       console.error('Erro ao buscar descrição do produto:', error);
  //     });
  // },
};
</script>
