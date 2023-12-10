<template>
    <div class="my-10 mx-4 md:mx-auto">
      <v-row>
        <v-col cols="12">
          <span class="text-xl text-gray-600">
            Descrição:
          </span>
          <p class="text-justify my-5 text-gray-500">
            {{ isDescriptionTruncated ? truncatedDescription : product.description }}
          </p>
          <v-btn variant="plain" v-if="isDescriptionTruncated" text @click="isDescriptionTruncated = false">
            Ver mais
          </v-btn>
        </v-col>
      </v-row>
    </div>
  </template>

  <script>
  export default {
    props: {
      product: Object,
    },
    data() {
      return {
        isDescriptionTruncated: true,
      };
    },
    computed: {
      truncatedDescription() {
        const maxLength = 400;
        return this.product.description.length > maxLength ?
               this.product.description.substring(0, maxLength) + '...' :
               this.product.description;
      },
    },
  };
  </script>
