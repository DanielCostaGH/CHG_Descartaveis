<template>
    <v-card>
      <v-card-title class="text-xl font-medium">Meus Favoritos</v-card-title>
      <v-card-text>
        <v-row>
          <v-col v-for="(produto, index) in produtos" :key="index" cols="3">
            <v-card href="/products/{product.id}" class="text-center">
              <v-img
                class="mx-auto"
                src="https://via.placeholder.com/150"
                max-height="80%"
              ></v-img>
              <v-card-title class="text-h6 mt-2">{{ produto.nome }}</v-card-title>
            </v-card>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </template>

  <script>
  export default {
    data() {
      return {
        produtos: [
          { nome: 'Produto 1' },
          { nome: 'Produto 2' },
          { nome: 'Produto 3' },
          { nome: 'Produto 3' },
          { nome: 'Produto 3' },
          { nome: 'Produto 3' },
          { nome: 'Produto 3' },

        ],
      };
    },
  };
  </script>
