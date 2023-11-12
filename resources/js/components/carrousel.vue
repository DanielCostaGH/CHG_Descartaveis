<template>
  <v-carousel cycle class="h-[60vh] bg-gray-100" hide-delimiter-background>
    <v-carousel-item v-for="(slide, i) in slides" :key="i">
      <v-sheet height="100%">
        <div class="flex h-5/6 justify-center align-center bg-gray-100">
          <img class="" :src="images[i]" alt="imagem" />
        </div>
      </v-sheet>
    </v-carousel-item>

    <!-- Personalize o delimiter-icon -->
    <template v-slot:delimiter="{ active }">
      <v-icon class="custom-delimiter-icon" :color="active ? 'success' : 'grey'">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="w-6 h-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
        </svg>

      </v-icon>
    </template>
  </v-carousel>
</template>

<script>
export default {
  data() {
    return {
      slides: ['First', 'Second', 'Third', 'Fourth', 'Fifth'],
      images: [
        '/images/slides/i1.png',
        '/images/slides/i2.png',
        '/images/slides/i3.png',
        '/images/slides/i4.png',
        '/images/slides/i5.png',
      ],
    };
  },
};
</script>

<style scoped>
/* Personalize o delimiter-icon */
.custom-delimiter-icon {
  font-size: 24px;
  /* Tamanho de fonte personalizado */
  padding: 5px;
  /* Espaçamento personalizado */
}

/* Efeito hover para o delimiter-icon */
.custom-delimiter-icon:hover {
  background-color: #FF5733;
  /* Cor de fundo personalizada no hover */
  color: #fff;
  /* Cor do ícone personalizada no hover */
}
</style>
