<template>
    <div>
      <div class="mb-4">
        <label for="productVariation" class="block text-gray-700 font-bold mb-2">Variação</label>
        <input
          type="text"
          id="productVariation"
          v-model="variation"
          class="w-full p-2 border rounded"
          placeholder="Variação"
        />
      </div>
      <div v-if="variations.length > 0">
        <label class="block text-gray-700 font-bold mb-2">Variações Adicionadas</label>
        <ul>
          <li v-for="(variation, index) in variations" :key="index" class="flex items-center mb-2">
            <span class="mr-2">{{ variation }}</span>
            <button @click="removeVariation(index)" type="button" class="text-red-500">
              <img :src="close" alt="" />
            </button>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      variations: Array,
    },
    data() {
      return {
        variation: '',
        close: '/images/close.svg',
      };
    },
    methods: {
      removeVariation(index) {
        this.variations.splice(index, 1);
      },
    },
  };
  </script>
  